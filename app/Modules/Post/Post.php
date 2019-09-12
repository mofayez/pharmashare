<?php

namespace App\Modules\Post;


use App\Models\Comment as CommentModel;
use App\Models\File as FileModel;
use App\Models\Post as PostModel;
use App\Modules\User\User;
use App\Support\Repository;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Facade;
use Illuminate\Support\Facades\Storage;


class Post extends Facade
{

    /**
     * @var Repository $globalRepository
     */
    private $globalRepository;


    /**
     * @var Post $user
     */
    private $post;


    /**
     * @var CommentModel $comment
     */
    private $comment;


    /**
     * @var mixed|string $postStoragePath
     */
    private $postStoragePath;


    /**
     * @var mixed|string $getPostStoragePath
     */
    private $getPostStoragePath;


    /**
     * @var mixed|string $getPostStoragePath
     */
    private $usersStoragePath;


    /**
     * @var mixed|string $getPostStoragePath
     */
    private $getUsersStoragePath;


    /**
     * @var User $user
     */
    private $user;

    /**
     * Instance OF AWS S3 Bucket Link
     */
    protected $aws_s3_base_link;

    /**
     * Post constructor.
     */
    public function __construct()
    {

        $this->globalRepository = new Repository();
        $this->post = new PostModel;
        $this->comment = new CommentModel();
        $this->user = new User();
        $this->postStoragePath = 'https://s3.amazonaws.com/pharmashare-files/'; //storage_path('files/posts');
        $this->usersStoragePath = 'https://s3.amazonaws.com/pharmashare-files/';// storage_path('files/users');
        $this->getPostStoragePath = 'https://s3.amazonaws.com/pharmashare-files/';  //asset('storage/files/posts') . '/';
        $this->getUsersStoragePath = 'https://s3.amazonaws.com/pharmashare-files/';// asset('storage/files/users') . '/';
//        $this->aws_s3_base_link = "https://s3.console.aws.amazon.com/s3/object/pharmashare-files/";

    } // end of constructor


    /**
     * create new post...
     *
     * @param array $data
     * @return array|null
     */
    public function create(array $data)
    {
        // dd($data);
        DB::beginTransaction();

        try {

            // save post
            $post = $this->globalRepository->create($this->post, $data);


            if (($post->user->role->role ?? null) == 'admin') {
                $post->is_approved = 1;
                $post->save();

            }

            // save post files
            if (isset($data['files']) && count($data['files']) > 0) {

                $files = [];
                foreach ($data['files'] as $file) {
                    $file_name = $file->store(
                        'posts',
                        's3'
                    );
//                    dd($file_name);
//                    $file_name = rand() . time() . '.' . $file->getClientOriginalExtension();
                    $files[] = new FileModel([
                        'fileable_id' => $post->id,
                        'fileable_type' => PostModel::class,
                        'name' => $file_name,
                        'mime_type' => $file->getClientMimeType(),
                    ]);
//                    $file->move($this->postStoragePath, $file_name);
                } // end foreach

                $this->globalRepository->applyRelation(
                    $post,
                    'files',
                    'saveMany',
                    $files
                );
            } // end if

            // save post media
            if (isset($data['media']) && count($data['media']) > 0) {

                $files = [];
                foreach ($data['media'] as $file) {
                    $file_name = $file->store(
                        'posts',
                        's3'
                    );
//                    dd($file_name);
//                    $file_name = rand() . time() . '.' . $file->getClientOriginalExtension();
                    $files[] = new FileModel([
                        'fileable_id' => $post->id,
                        'fileable_type' => PostModel::class,
                        'name' => $file_name,
                        'mime_type' => $file->getClientMimeType(),
                    ]);
//                    $file->move($this->postStoragePath, $file_name);
                } // end foreach

                $this->globalRepository->applyRelation(
                    $post,
                    'files',
                    'saveMany',
                    $files
                );
            } // end if

            DB::commit();

        } catch (\Exception $exception) {

            return return_msg(false, $exception->getMessage(), []);
        }

        if (!$post) {

            return return_msg(false, '', []);
        } // end if

        $this->getPostData($post);

        $user = $this->user->find($post->user_id)['data']['user'] ?? null; // get user
        $return_message = $user->username ?? '' . ' ' . __('profile.n_addPost');

        return return_msg(true, $return_message, compact('post', 'user'));

    } // end of create function

    protected function getPostData(Model &$post)
    {

        $post->files; // get post files.
        if (count($post->files) > 0) {
            foreach ($post->files as $key => $file) {

                $post->files[$key] = [
                    'name' => $file ? $this->getPostStoragePath . $file->name : null,
                    'file_type' => $file ? explode('/', $file->mime_type)[0] : null
                ];
            }
        }

        $this->user->getRelatedUserImagePath($post);

        $post->comments; // get post comments.

        if (count($post->comments) > 0) {
            foreach ($post->comments as $comment) {

                $comment->posted_at = $comment->created_at->diffForHumans(Carbon::now());

                $this->user->getRelatedUserImagePath($comment);

                $comment->comment = $this->replaceMention($comment->comment);

                $comment->likes;
                if (count($comment->likes) > 0) {
                    foreach ($comment->likes as $like) {

                        $this->user->getRelatedUserImagePath($like);

                        $reaction_type = $like->reaction->reaction;
                        $like->reaction_type = $reaction_type; 
                                  
                        unset($like->user->image, $like->reaction); 
                    }
                }

                unset($comment->user->image);
            }
        }

        $post->likes;
        if (count($post->likes) > 0) {
            foreach ($post->likes as $like) {

                $this->user->getRelatedUserImagePath($like);

                $reaction_type = $like->reaction->reaction;
                $like->reaction_type = $reaction_type;
 
                      
                unset($like->user->image, $like->reaction);  
            }
        }

        $post->posted_at = $post->created_at->diffForHumans(Carbon::now());
        $post->type = boolval($post->post) ? 'text' : 'images';
        $post->fileCount = count($post->files);
    }

    public function replaceMention($text)
    {

        preg_match_all('/@\w+/i', $text, $_matches);

        $matches = $_matches[0];

        foreach ($matches as $match) {

            $username = str_replace('@', '', $match);

            $find_user = $this->user->findUserByUsername($username);

            if (!$find_user['status']) {

                continue;
            }

            $username_link = "<a href=" . route('getUserProfileView', ['username' => '@' . $username, 'id' => $find_user['data']['user']->id]) . ">{$match}</a>";

            $text = str_replace($match, $username_link, $text);
        }

        return $text;
    } // end of function

    /**
     * get all posts...
     *
     * @return array|null
     */
    public function all($post_type = null, $is_approved = 1)
    {

//        $posts = $this->globalRepository->all($this->post)->sortByDesc('updated_at')->values();

        $user = auth()->user();

        $last_admin_post = $this->post->orderBy('updated_at', 'desc')
            ->where('is_approved', $is_approved)
            ->whereHas('user', function ($query) {
                $query->whereHas('role', function ($q) {
                    $q->where('title', 'admin');
                });
            })->get()->first();

        if ($last_admin_post) {

            if ($user->role->role === 'admin') {

                $posts = $this->post
                    ->orderBy('updated_at', 'desc')
                    ->where('is_approved', $is_approved)
                    ->where('id', '!=', $last_admin_post->id ?? 0)
                    ->get()
                    ->prepend($last_admin_post);

            } else {

                $posts = $this->post
                    ->orderBy('updated_at', 'desc')
                    ->where('is_approved', $is_approved)
                    ->where('id', '!=', $last_admin_post->id ?? 0)
                    ->whereHas('user', function ($query) use ($user) {
                        $query->whereHas('role', function ($q) use ($user) {
                            $q->whereIn('title', ['admin', $user->role->title]);
                        });
                    })
                    ->get()
                    ->prepend($last_admin_post);
            }

        } else {

            if ($user->role->role === 'admin') {

                $posts = $this->post
                    ->orderBy('updated_at', 'desc')
                    ->where('is_approved', $is_approved)
                    ->get();

            } else {

                $posts = $this->post
                    ->orderBy('updated_at', 'desc')
                    ->where('is_approved', $is_approved)
                    ->whereHas('user', function ($query) use ($user) {
                        $query->whereHas('role', function ($q) use ($user) {
                            $q->whereIn('title', ['admin', $user->role->title]);
                        });
                    })
                    ->get();
            }

        }

        foreach ($posts as $post) {

            $this->getPostData($post);
        } // end foreach

        if ($post_type == 'text') {
            $posts = $posts->filter(function ($post) {

                return $post->post_type == 'text';
            });
        }
        if ($post_type == 'media') {
            $posts = $posts->filter(function ($post) {

                return $post->post_type == 'media';
            });
        }
        if ($post_type == 'link') {
            $posts = $posts->filter(function ($post) {

                return $post->post_type == 'link';
            });
        }
        if ($post_type == 'files') {
            $posts = $posts->filter(function ($post) {

                return $post->post_type == 'files';
            });
        }
        if ($post_type == 'mine') {
            $user_id = auth()->user()->id ?? null;

            $posts = $posts->where('user_id', $user_id);
        }

        return return_msg(true, 'posts...', compact('posts'));
    } // end of function

    /**
     * get post by id...
     *
     * @param $id
     * @return array|null
     */
    public function find($id)
    {
        // search post...
        $post = $this->globalRepository->find($this->post, $id);

        if (!$post) {

            return return_msg(false, '', []);
        } // end if

        $this->getPostData($post);

        return return_msg(true, 'created...', compact('post'));
    } // end of function

    /**
     * comment on post
     *
     * @param array $data
     * @return array|null|string
     */
    public function comment(array $data)
    {

        $post_id = $data['post_id'];

        $post = $this->globalRepository->find($this->post, $post_id);

        if (!$post) {

            return return_msg(false, '', []);
        } // end if

        $user_id = $data['user_id'];
        $comment = $data['comment'];
        $comment_data = compact('user_id', 'comment');

        // save comment
        try {

            $comment = $this->globalRepository
                ->applyRelation(
                    $post,
                    'comments',
                    'create',
                    $comment_data
                );

            $this->user->getRelatedUserImagePath($comment);

        } catch (\Exception $exception) {

            return $exception->getMessage();
        }

        // replace mentions with hyperlink...
        $comment->comment = $this->replaceMention($comment->comment);

        $user = $this->user->find($post->user_id)['data']['user'] ?? null; // get user
        $return_message = $user->username ?? '' . ' ' . __('profile.n_addComment');

        return return_msg(true, $return_message, compact('comment', 'user', 'post'));
    }

    /***
     * reply comment...
     *
     * @param array $data
     * @return array|null
     */
    public function replyComment(array $data)
    {

        $comment_id = $data['comment_id'];

        $comment = $this->globalRepository->find($this->comment, $comment_id);

        if (!$comment) {

            return return_msg(false, '', []);
        } // end if

        $user_id = $data['user_id'];
        $comment_data = [
            'user_id' => $user_id,
            'comment' => $data['comment']
        ];

        $this->globalRepository
            ->applyRelation(
                $comment,
                'replies',
                'create',
                $comment_data
            );

        return return_msg(true, 'created...', compact('comment'));
    }

    public function updatePost(array $data)
    {

        $post_id = $data['post_id'];

        $post = $this->globalRepository->find($this->post, $post_id);

        if (!$post) {

            return return_msg(false, 'Not found');
        } // end if

        DB::beginTransaction();

        try {

            // save post
            $post = $this->globalRepository->update($post, $data);

            // save post files
            if (isset($data['files']) && count($data['files']) > 0) {

                $files = $post->files;
                foreach ($files as $file) {

                    if (!$file) {
                        continue;
                    }

//                    @unlink($this->postStoragePath . $file->name);

                    Storage::disk('s3')->delete($file->name);
                    $file->delete();
                }

                $files = [];
                foreach ($data['files'] as $file) {

                    $file_name = $file->store(
                        'posts',
                        's3'
                    );
                    $files[] = new FileModel([
                        'fileable_id' => $post->id,
                        'fileable_type' => PostModel::class,
                        'name' => $file_name,
                        'mime_type' => $file->getClientMimeType(),
                    ]);

//                    $file->move($this->postStoragePath, $file_name);

                } // end foreach

                $this->globalRepository->applyRelation(
                    $post,
                    'files',
                    'saveMany',
                    $files
                );
            } // end if

            DB::commit();

        } catch (\Exception $exception) {

            return return_msg(false, $exception->getMessage(), []);
        }

        if (!$post) {

            return return_msg(false, '', []);
        } // end if

        $this->getPostData($post);

        $user = $this->user->find($post->user_id)['data']['user'] ?? null; // get user
        $return_message = $user->username ?? '' . ' ' . __('profile.n_addPost');

        return return_msg(true, $return_message, compact('post', 'user'));
    }


    public function deletePost($post_id)
    {
        $post = $this->globalRepository->find($this->post, $post_id);

        if (!$post) {

            return return_msg(false, 'Not found');
        } // end if

        $files = $post->files;
        foreach ($files as $file) {
            if (!$file) {
                continue;
            }
            Storage::disk('s3')->delete($file->name);
            $file->delete();
        }
        $post->delete();

        return return_msg(true, 'ok');
    }


    public function deleteComment(int $id)
    {

        $this->globalRepository = new Repository();
        $this->comment = new CommentModel;

        $comment = $this->globalRepository->find($this->comment, $id);

        if (!$comment) {
            return return_msg(false, 'not found', compact('comment'));
        }

        $comment->delete();

        return return_msg(true, 'ok');
    }

}