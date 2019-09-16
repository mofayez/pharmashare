<?php

namespace App\Http\Controllers\Api;

use App\Events\CreatePost;
use App\Events\CreatePostComment;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Modules\Post\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{


    /**
     * @var Post $post
     */
    private $post;


    /**
     * PostController constructor.
     */
    public function __construct()
    {

        $this->post = new Post();
    } // end constructor


    public function getAllPosts($post_type = null, $is_approved = 1)
    {
        return $this->post->all($post_type,$is_approved);
    }


    /**
     * create new post
     *
     * @param Request $request
     * @return array|null
     */
    public function createNewPost(Request $request)
    {

        $data = $request->all();

        $return = $this->post->create($data);
        if ($return['status']) {
            $return['data']['notification'] = __('profile.notification');
            $return['data']['message'] = $return['msg'];
            $data = $return['data'];
            broadcast(new CreatePost($data))->toOthers();
        }
        return $return;
    }


    /**
     * get post by id...
     *
     * @param $id
     * @return array|null
     */
    public function getPost($id)
    {

        return $this->post->find($id);
    }


    /**
     * comment on post
     * @param Request $request
     * @return array|null|string
     */
    public function makeComment(Request $request)
    {

        // validate request
        $validation = validator($request->all(), [
            'comment' => 'required|min:2|max:200',
        ]);

        if ($validation->fails()) {

            return return_msg(false, 'validation error...', [
                'errors' => $validation->getMessageBag()->getMessages()
            ]);
        }

        $data = $request->all();

        $return = $this->post->comment($data);

        if ($return['status']) {
            $return['data']['notification'] = __('profile.notification');
            $return['data']['message'] = $return['msg'];
            $data = $return['data'];
            broadcast(new CreatePostComment($data))->toOthers();
        }
        return $return;
    }


    /**
     * @param Request $request
     * @return array|null
     */
    public function replyComment(Request $request)
    {

        // validate request
        $validation = validator($request->all(), [
            'comment' => 'required|min:2|max:200',
        ]);

        if ($validation->fails()) {

            return return_msg(false, 'validation error...', [
                'errors' => $validation->getMessageBag()->getMessages()
            ]);
        }

        $data = $request->all();

        return $this->post->replyComment($data);
    }


    public function updatePost(Request $request)
    {

        $validation = $this->validateUpdatePostRequest($request);
        if ($validation->fails()) {

            return return_msg(false, 'validation errors', [
                'validation_errors' => $validation->getMessageBag()->getMessages()
            ]);
        }

        return $this->post->updatePost($request->all());
    }

    protected function validateUpdatePostRequest(Request $request)
    {

        $validation = validator($request->all(), [
            'post_id' => 'required'
        ]);

        return $validation;
    }


    public function deletePost($post_id)
    {

        return $this->post->deletePost($post_id);
    }


    public function deleteComment($id)
    {

        return $this->post->deleteComment($id);
    }
}