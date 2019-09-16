<?php

namespace App\Http\Controllers\Web\Blog;

use App\Events\CreatePostLike;
use App\Http\Controllers\Api\ReactionController as RcController;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ReactionController extends Controller
{
    private $reaction;

    public function __construct()
    {
        $this->reaction= new RcController();
    }

    public function addPostLike(Request $request)
    {
       $return = $this->reaction->makeLike($request);
       if ($return['status']){
           $return['data']['notification'] = __('profile.notification');
           $return['data']['message'] = $return['msg'];
           $data = $return['data'];
           broadcast(new CreatePostLike($data))->toOthers();
       }
        return $return;
    }

    public function getPostReactions(Request $request)
    {
        return $this->reaction->getPostReactions($request);
    }
}
