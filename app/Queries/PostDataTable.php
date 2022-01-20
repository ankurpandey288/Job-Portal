<?php

namespace App\Queries;

use App\Models\Post;

/**
 * Class PostDataTable
 */
class PostDataTable
{
    /**
     * @return Post
     */
    public function get()
    {
        /** @var Post $query */
        $query = Post::query()->select('posts.*');

        return $query;
    }
}
