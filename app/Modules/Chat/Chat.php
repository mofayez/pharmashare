<?php
/**
 * Created by PhpStorm.
 * User: fayez
 * Date: 10/18/2018
 * Time: 15:01
 */

namespace App\Modules\Chat;

use App\Events\MessageEvent;
use App\Models\Chat as ChatModel;
use App\Modules\User\User;
use App\Support\Repository;
use Carbon\Carbon;

class Chat
{

    /**
     * @var Repository
     */
    private $globalRepository;

    /**
     * @var ChatModel
     */
    private $chatModel;


    /**
     * @var User
     */
    private $user;


    /**
     * Chat constructor.
     */
    public function __construct()
    {

        $this->globalRepository = new Repository();
        $this->chatModel = new ChatModel;
        $this->user = new User();
    } // end of constructor


    /**
     * create new message
     * @param array $data
     * @return array|null
     */
    public function createMessage(array $data)
    {

        $message = $this->globalRepository->create($this->chatModel, $data);

        $to_user = $this->user->find($data['to_user_id'])['data']['user'] ?? null;
        $from_user = $this->user->find($data['from_user_id'])['data']['user'] ?? null;

        $this->chatModel
            ->whereFromUserId($data['from_user_id'])
            ->whereToUserId($data['from_user_id'])
            ->whereReadAt(null)
            ->update(['read_at' => Carbon::now()]);

        $data = compact('to_user', 'from_user', 'message');
        event(new MessageEvent($data)); // fire message event

        return return_msg(true, 'created...', compact('message'));
    } // end of function


    /**
     * get user chat
     *
     * @param array $data
     * @return array|null
     */
    public function getChat(array $data)
    {

        $from_user_id = $data['from_user_id'];
        $to_user_id = $data['to_user_id'];

        $chat['messages'] = $this->chatModel
            ->orderBy('created_at')
            ->where([
                ['from_user_id', $to_user_id],
                ['to_user_id', $from_user_id]
            ])
            ->orWhere([
                ['from_user_id', $from_user_id],
                ['to_user_id', $to_user_id]
            ])
            ->get();

        $chat['withUser'] = $this->user->find($to_user_id)['data']['user'] ?? null;

        $this->chatModel
            ->whereFromUserId($to_user_id)
            ->whereToUserId($from_user_id)
            ->whereReadAt(null)
            ->update(['read_at' => Carbon::now()]);

        return return_msg(true, 'chat messages', compact('chat'));
    } // end of function


    public function getChattedUsers($from_user_id, $data)
    {

        $chatted_users = $this->getAllChats(compact('from_user_id'))['data']['chats'];

        $chatted_users = $chatted_users->map(function ($chatted_user) {

            unset($chatted_user['messages']);
            return $chatted_user;
        });

        if (isset($data['query']) && $data['query']) {

            $query = $data['query'];

            $chatted_users = $chatted_users->filter(function ($chat) use ($query) {

                return false !== stristr($chat['withUser']->username, $query) ||
                    false !== stristr($chat['withUser']->firstname, $query) ||
                    false !== stristr($chat['withUser']->latname, $query);
            });
        }


        return return_msg(true, 'ok', compact('chatted_users'));
    }


    /**
     * retrieve all chats for one user
     *
     * @param array $data
     * @return array|null
     */
    public function getAllChats(array $data)
    {

        $user_id = $data['from_user_id'];

        $other1 = $this->chatModel
            ->where('from_user_id', $user_id)
            ->pluck('to_user_id')
            ->toArray();

        $other2 = $this->chatModel
            ->where('to_user_id', $user_id)
            ->pluck('from_user_id')
            ->toArray();

        $others = array_values(array_unique(array_merge($other1, $other2)));

        $chats = [];
        foreach ($others as $other) {

            $chat['messages'] = $this->chatModel
                ->where([
                    ['from_user_id', $user_id],
                    ['to_user_id', $other]
                ])
                ->orWhere([
                    ['from_user_id', $other],
                    ['to_user_id', $user_id]
                ])
                ->get();
            $chat['withUser'] = $this->user->find($other)['data']['user']->load(['role']) ?? null;

            $chat['lastMessages'] = $chat['messages']->last();
            $chat['lastMessageFromHim'] = $chat['messages']->where('to_user_id', $user_id)->last();

            $chats[] = $chat;
        }

        $chats = collect($chats);

        $chats = $chats->sortByDesc(function ($chat) {

            return $chat['messages']->last()->created_at;
        });

        if (isset($data['query']) && $data['query']) {

            $query = $data['query'];

            $chats = $chats->filter(function ($chat) use ($query) {

                return false !== stristr($chat['withUser']->username, $query) ||
                    false !== stristr($chat['withUser']->firstname, $query) ||
                    false !== stristr($chat['withUser']->latname, $query);
            });
        }

        return return_msg(true, 'chat messages', compact('chats'));
    } // end of function


    /**
     * delete chat
     *
     * @param array $data
     * @return array|null
     * @throws \Exception
     */
    public function deleteChat(array $data)
    {
        $from_user_id = $data['from_user_id'];
        $to_user_id = $data['to_user_id'];

        $chat = $this->globalRepository->findWhere($this->chatModel, [
            compact('from_user_id'), compact('to_user_id')
        ]);

        if (count($chat) > 0) {

            return return_msg(false, 'No Found...');
        }

        $this->globalRepository->delete($chat); // delete chat from database

        return return_msg(true, 'chat was deleted...');
    } // end of function


    public function getLastNumberOfMessagesForUser($user_id, $num_msg = 5)
    {

        $messages = $this->chatModel
            ->orderBy('created_at', 'DESC')
            ->whereToUserId($user_id)
            ->whereReadAt(null)
            ->with('fromUser')
            ->get()
            ->unique('from_user_id');

        $messages = $messages->take($num_msg);
        $messgaes_count = count($messages);

        foreach ($messages as $message) {

            $this->user->getUserImagePath($message->fromUser);
        }

        return return_msg(true, 'ok', compact('messages', 'messgaes_count'));
    }

}