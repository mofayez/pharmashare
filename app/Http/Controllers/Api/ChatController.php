<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Modules\Chat\Chat;
use Illuminate\Http\Request;

class ChatController extends Controller
{

    private $chat;


    public function __construct()
    {

        $this->chat = new Chat();
    }


    public function createChatMessage(Request $request)
    {

        $validation = $this->validateChatMessageRequest($request);

        if ($validation->fails()) {

            return return_msg(false, 'validation errors...', [
                'validation_errors' => $validation->getMessageBag()->getMessages()
            ]);
        } // end if

        return $this->chat->createMessage($request->all());
    } // end of function

    protected function validateChatMessageRequest(Request $request)
    {

        $validation = validator($request->all(), [
            'from_user_id' => 'required',
            'to_user_id' => 'required',
            'message' => 'required'
        ]);

        return $validation;
    } // end of function


    public function getChattedUsers(Request $request, $user_id)
    {

        return $this->chat->getChattedUsers($user_id, $request->all());
    }


    public function getUserChat(Request $request)
    {

        return $this->chat->getChat($request->all());
    } // end of function

    public function getUserChats(Request $request)
    {

        return $this->chat->getAllChats($request->all());
    } // end of function


    public function getLastNumberOfMessagesForUser($user_id, $num_msg = 5)
    {

        return $this->chat->getLastNumberOfMessagesForUser($user_id, $num_msg);
    }

} // end of ChatController class
