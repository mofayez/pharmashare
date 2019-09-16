<?php

namespace App\Http\Controllers\Web\Chat;

use App\Http\Controllers\Api\AdsController;
use App\Models\AdsControl;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ChatController extends Controller
{
    private $chat_ctrl;
    private $ads;


    public function __construct()
    {
        $this->chat_ctrl = new \App\Http\Controllers\Api\ChatController();
        $this->ads = new AdsController();
    }

    public function index(Request $request)
    {
        $user = auth()->user();
        $user->image = (new \App\Modules\User\User())->getUserImagePath($user);

        $all_users = User::all();

        $allowed_ads = AdsControl::where('status', 1)->get()->pluck(['title'])->toArray();
        $second_ratio = [];
        $response2 = $this->ads->getAllAdsCategorized();
        if ($response2['status']) {

            $second_ratio = $response2['data']['second_ratio'];
        }

        $response = $this->chat_ctrl->getChattedUsers($request, $user->id);
        $chat_history = collect([]);
        if ($response['status']) {
            $chat_history = $response['data']['chatted_users'];
        }
        // return $chat_history;

        return view('pages.chat.index', compact('user', 'chat_history', 'all_users','allowed_ads','second_ratio'));
    }

    public function postSendMessage(Request $request)
    {
//        return $request->all();
        return $this->chat_ctrl->createChatMessage($request);
    }

    public function getChatMessages(Request $request)
    {
        return $this->chat_ctrl->getUserChat($request);
        return $request->all();
    }
}
