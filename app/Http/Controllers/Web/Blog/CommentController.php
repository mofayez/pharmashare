<?php

namespace App\Http\Controllers\Web\Blog;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Api\PostController as PsController;

class CommentController extends Controller
{
    private $post;

    public function __construct()
    {
        $this->post = new PsController();
    }

    public function addPostComment(Request $request)
    {
        $request['user_id'] = auth()->user()->id;
        return $this->post->makeComment($request);
    }

    public function deleteComment(Request $request)
    {
        $request['user_id'] = auth()->user()->id;
        return $this->post->deleteComment($request->comment_id);

    }
}
