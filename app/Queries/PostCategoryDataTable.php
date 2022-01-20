<?php

namespace App\Queries;

use App\Models\PostCategory;

/**
 * Class PostCategoryDataTable
 */
class PostCategoryDataTable
{
    /**
     * @return PostCategory
     */
    public function get()
    {
        /** @var PostCategory $query */
        $query = PostCategory::query()->select('post_categories.*');

        return $query;
    }
}
