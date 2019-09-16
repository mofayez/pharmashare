<?php

namespace App\Modules\Post;


use App\Support\Repository;
use App\Models\Like as LikeModel;
use App\Models\Post as PostModel;
use App\Modules\User\User;
use App\Models\Comment as CommentModel;
use App\Models\Reaction as ReactionModel;


class Reaction
{


    private $globalRepository;


    private $like;


    private $reaction;


    private $post;


    private $comment;


    private $user;


    /**
     * @var mixed|string $getPostStoragePath
     */
    private $getUsersStoragePath;


    public function __construct()
    {

        $this->globalRepository = new Repository();
        $this->like = new LikeModel;
        $this->reaction = new ReactionModel;
        $this->post = new Post();
        $this->comment = new Comment();
        $this->user = new User();
        $this->getUsersStoragePath = asset('storage/files/users') . '/';
    }


    public function like($data)
    {

        $likeable_id = $data['likeable_id'];
        $likeable_type = $data['likeable_type'];
        $user_id = $data['user_id'];
        $reaction_id = $data['reaction_id'];

        $likeable = null;
        $_likeable_type = null;
        if ($likeable_type == 'post') {

            $likeable = $this->post->find($likeable_id);
            $_likeable_type = PostModel::class;
        } else {

            $likeable = $this->comment->find($likeable_id);
            $_likeable_type = CommentModel::class;
        }

        if (!$likeable['msg']) {

            return return_msg(false, 'not found...', []);
        }

        $like_exists = LikeModel::where([
            ['user_id', $data['user_id']],
            ['likeable_id', $likeable_id],
            ['likeable_type', $_likeable_type]
        ])->first();

        if ($like_exists) {
            return return_msg(false, 'already liked..', []);
        }

        $likeable = $likeable['data'][$likeable_type];
        $like_data = compact('user_id', 'reaction_id');
        $this->globalRepository->applyRelation(
            $likeable,
            'likes',
            'create',
            $like_data
        );

        $user = $this->user->find($user_id)['data']['user'] ?? null; // get user
        $post = null;
        if ($likeable_type == 'post') {
            $post = $this->post->find($likeable_id)['data']['post'] ?? null;
        }
        $return_message = $user->username . ' ' . __('profile.n_addLike');

        return return_msg(true, $return_message, compact('user', 'post'));
    }


    public function dislike($data)
    {

        $like_id = $data['like_id'];

        $like = $this->globalRepository->find($this->like, $like_id);

        if (!$like) {

            return return_msg(false, 'not found', []);
        }

        $this->globalRepository->delete($like, $like_id);

        return return_msg(true, 'deleted...', []);
    }


    public function getReactions()
    {

        $reactions = $this->globalRepository->all($this->reaction);

        return return_msg(true, 'reactions...', compact('reactions'));
    }


    public function getPostReactions($data)
    {
        $post = $this->post->find($data['post_id']);
        $post = $post['data']['post'] ?? null;
        if (!$post) {
            return return_msg(false, "Post not found", []);
        }

//        dd($post);
        $post->likes;
        if (count($post->likes) > 0) {
            foreach ($post->likes as $like) {

                $reaction_type = $like->reaction->reaction;
                $like->reaction_type = $reaction_type;

                unset($like->user->image, $like->reaction);
            }
        }
        return return_msg(true, 'likes ...', compact('post'));
    }

}