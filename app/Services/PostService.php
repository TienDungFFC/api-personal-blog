<?php 

namespace App\Services;

use App\Repositories\Post\PostRepository;

class PostService {
    public function __construct(
        private PostRepository $postRepo,
        private TagService $tagService,
        private CategoryService $categoryService
    ) {}
    
    const DESCRIPTION_LENGTH = 200;

    public function createPost($postInput) {
        $content = !empty($postInput['content']) ? $postInput['content'] : '';
        $thumb = !empty($postInput['thumb']) ? $postInput['thumb'] : '';
        $categoryId = !empty($postInput['categoryId']) ? $postInput['categoryId'] : null;
        //TODO: get info author later
        // $author = $postInput['user'];
        $tags = $postInput['tags'];
        $postData = [
            'title' => $postInput['title'] ?? '',
            'slug' => create_slug($postInput['title']),
            'description' => getCharactersWithOutHTMLTags($content, self::DESCRIPTION_LENGTH) . '...',
            'content' => $content,
            'thumbnail' => $thumb,
            'category' => $this->categoryService->getCategory($categoryId),
            'author' => [
                'slug' => 'admin',
                'name' => 'Admin'
            ],
            'tags' => $tags,
            'status' => !empty($postInput['status']) ? $postInput['status'] : 0,
        ];
        $newPost = $this->postRepo->create($postData);
        $this->tagService->addNewTagIfExist($newPost['tags']);
        return $newPost;
    }

    public function getAll() {
        return $this->postRepo->all();
    }
}