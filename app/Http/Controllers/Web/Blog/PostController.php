<?php

namespace App\Http\Controllers\Web\Blog;

use App\Http\Controllers\Api\AdsController;
use App\Http\Controllers\Api\PostController as PsController;
use App\Models\AdsControl;
use App\Models\User;
use App\Modules\User\User as UserModule;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Pagination\LengthAwarePaginator;

class PostController extends Controller
{
    private $post;


    /**
     * @var UserModule $user
     */
    private $user;


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

    private $ads;

    public function __construct()
    {
        $this->post = new PsController();
        $this->user = new UserModule();
        $this->ads = new AdsController();

        $this->postStoragePath = storage_path('files/posts');
        $this->usersStoragePath = storage_path('files/users');
        $this->getPostStoragePath = asset('storage/files/posts') . '/';
        $this->getUsersStoragePath = asset('storage/files/users') . '/';
    }

    public function getGroupPosts(Request $request)
    {
        $page_title = "Group";
        $response = $this->post->getAllPosts($request->post_type);

//        return $response;
        $allowed_ads = AdsControl::where('status', 1)->get()->pluck(['title'])->toArray();

        if ($response['status']) {

            $posts = $response['data']['posts'];

            $user = auth()->user();
            $this->user->getUserImagePath($user);

            $all_users = $this->user->all();


            $first_ratio = [];
            $second_ratio = [];
            $response2 = $this->ads->getAllAdsCategorized();
            if ($response2['status']) {

                $first_ratio = $response2['data']['first_ratio'];
                $second_ratio = $response2['data']['second_ratio'];
            }

            $currentPage = LengthAwarePaginator::resolveCurrentPage();
            $itemCollection = collect($posts);
            $perPage = 5;
            $currentPageItems = $itemCollection->slice(($currentPage * $perPage) - $perPage, $perPage)->all();
            $posts = new LengthAwarePaginator($currentPageItems, count($itemCollection), $perPage);
            $posts->setPath($request->url());

            $paginate = true;
            // return $posts;
            return view('pages.feeds.index', compact('page_title', 'posts', 'user', 'all_users', 'allowed_ads', 'paginate', 'first_ratio', 'second_ratio'));
        }
    }

    public function addNewGroupPosts(Request $request)
    {

        // return $request->all();
        $rules = [
            'post' => 'required|min:2|max:1000',
            'files.*' => 'file|max:200000'
        ];

        if ($request->file('files') || $request->file('media') || $request->file('link')) {
            $rules = [
                'post' => 'nullable|min:2|max:1000',
                'files.*' => 'file|max:200000'
            ];
        }
        if($request->post_type == 'link'){ 
            $rules = [
                'post' => 'required|min:2|max:1000',
                'link' => 'required|url'
                
            ];
        }
        $validation = validator($request->all(), $rules);
        if ($validation->fails()) {

            return return_msg(false, 'validation error...', [
                'errors' => $validation->getMessageBag()->getMessages()
            ]);
        }

        $request['user_id'] = auth()->user()->id;
        $response = $this->post->createNewPost($request);

        $allowed_ads = AdsControl::where('status', 1)->get()->pluck(['title'])->toArray();

        if ($response['status']) {

            $user = auth()->user();
            $this->user->getUserImagePath($user);

            $first_ratio = [];
            $second_ratio = [];
            $posts = [$response['data']['post']];
            $currentPage = LengthAwarePaginator::resolveCurrentPage();
            $itemCollection = collect($posts);
            $perPage = 5;
            $currentPageItems = $itemCollection->slice(($currentPage * $perPage) - $perPage, $perPage)->all();
            $posts = new LengthAwarePaginator($currentPageItems, count($itemCollection), $perPage);
            $posts->setPath($request->url());

            $paginate = false;
            $view = view('pages.feeds.templates.post_types', compact('posts', 'user', 'paginate', 'first_ratio', 'allowed_ads', 'second_ratio'))->render();

            $response['view'] = $view;
            $response['user'] = $user;
        }
        return $response;
    }

    public function getPostTemplateAjax(Request $request)
    {
        $user = auth()->user();
        $user->image = $this->user->getUserImagePath($user) ?? null;

        $return = $this->post->getPost($request->post_id);
        $posts = [];
        if ($return['status']) {
            $posts = collect($return['data']);
        }
        $allowed_ads = AdsControl::where('status', 1)->get()->pluck(['title'])->toArray();

        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $itemCollection = collect($posts);
        $perPage = 5;
        $currentPageItems = $itemCollection->slice(($currentPage * $perPage) - $perPage, $perPage)->all();
        $posts = new LengthAwarePaginator($currentPageItems, count($itemCollection), $perPage);
        $posts->setPath($request->url());

        $paginate = false;
        $first_ratio = [];
        $second_ratio = [];
        $view = view('pages.feeds.templates.post_types', compact('posts', 'user', 'allowed_ads', 'paginate', 'first_ratio', 'second_ratio'))->render();
        return [
            'status' => true,
            'data' => [
                'view' => $view
            ]
        ];
    }

    public function getPostJsonAjax(Request $request)
    {
        $user = auth()->user();
        $user->image = $this->user->getUserImagePath($user) ?? null;

        return $this->post->getPost($request->post_id);
    }

    public function getUserMentions()
    {
        $users = $this->user->all();

        $data = [];
        foreach ($users as $user) {

            $data[] = [
                "id" => $user->id,
                "name" => $user->username,
                "_avatar" => $user->image_path ?? asset("assets/img/user_avatar.jpg"),
                "avatar" => $user->image ? asset("storage/files/users") . "/" . $user->image->name : asset("assets/img/user_avatar.jpg"),
                "type" => "contact"
            ];
        }
        return $data;

    }


    public function deletePost(Request $request)
    {
        return $this->post->deletePost($request->post_id);
    }

}