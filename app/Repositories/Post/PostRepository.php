<?php

namespace App\Repositories\Post;

use App\Models\Post;
use App\Repositories\BaseRepository;
use Illuminate\Contracts\Pagination\Paginator;

class PostRepository extends BaseRepository {
    const LIMIT_PAGINATION = 10;

    public function __construct(Post $post) 
    {
        parent::__construct($post);
    }

    public function paginate(): Paginator
    {
        return Post::query()
            ->orderBy('updated_at')
            ->simplePaginate(self::LIMIT_PAGINATION);
    }

    public function getPostByCate($cate): Paginator
    {
        return Post::query()
            ->where('category.slug', $cate)
            ->orderBy('updated_at')
            ->simplePaginate(self::LIMIT_PAGINATION);
    }
}