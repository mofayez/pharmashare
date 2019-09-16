<?php
/**
 * Created by PhpStorm.
 * User: fayez
 * Date: 10/5/2018
 * Time: 22:45
 */

namespace App\Modules\Post;

use App\Models\Comment as CommentModel;
use App\Support\Repository;


class Comment
{


    /**
     * @var CommentModel $comment
     */
    private $comment;


    /**
     * @var Repository $globalRepository
     */
    private $globalRepository;


    /**
     * search for a comment by id...
     *
     * @param int $id
     * @return array|null
     */
    public function find(int $id)
    {

        $this->globalRepository = new Repository();
        $this->comment = new CommentModel;

        $comment = $this->globalRepository->find($this->comment, $id);

        return return_msg(true, 'comment..', compact('comment'));
    }


}