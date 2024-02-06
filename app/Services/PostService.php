<?php 

namespace App\Services;

use App\Repositories\Post\PostRepository;

class PostService {
    public function __construct(private PostRepository $postRepo) {}

    public function createPost($postInput) {
        $content = !empty($postInput['content']) ? $postInput['content'] : '';
        $thumb = !empty($postInput['thumb']) ? $postInput['thumb'] : '';
        $categoryData = !empty($postInput['category']) ? $postInput['category'] : null;
        $author = $postInput['user'];
        $tags = $postInput['tags'];
        $categoryData = [
            'title' => $postInput['title'] ?? '',
            'slug' => $postInput['title'],
            'description' => !empty($postInput['description']) ? $postInput['description'] : '',
            'content' => $content,
            'thumbnail' => $thumb,
            'category' => $categoryData,
            'category_slug' => !empty($categoryData['slug']) ? $categoryData['slug'] : '',
            'author' => $author,
            'tags' => $tags,
            'status' => !empty($postInput['status']) ? $postInput['status'] : 0,
            'parent_id' => null
        ];
        return $this->postRepo->create($categoryData);
    }

    public function getAll() {
        return $this->postRepo->all();
    }
}