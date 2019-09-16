<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Modules\Post\Reaction;
use Illuminate\Http\Request;

class ReactionController extends Controller
{


    /**
     * @var Reaction $reaction
     */
    private $reaction;


    /**
     * ReactionController constructor.
     */
    public function __construct()
    {

        $this->reaction = new Reaction();
    } // end constructor


    public function getAllReactions()
    {

        return $this->reaction->getReactions();
    }


    public function makeLike(Request $request)
    {

        return $this->reaction->like($request->all());
    }

    public function dislike(Request $request)
    {

        return $this->reaction->dislike($request->all());
    }

    public function getPostReactions(Request $request)
    {
        return $this->reaction->getPostReactions($request->all());
        
    }
}
