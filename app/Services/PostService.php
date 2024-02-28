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

    public function index() {
        return $this->postRepo->paginate(); 
    }

    public function getPostByCate(string $cate) {
        return $this->postRepo->getPostByCate($cate);
    }

    public function createPost($postInput) {
        $content = !empty($postInput['content']) ? $postInput['content'] : '';
        $thumb = !empty($postInput['thumb']) ? $postInput['thumb'] : '';
        $categoryId = !empty($postInput['categoryId']) ? $postInput['categoryId'] : null;
        //TODO: get info author later
        // $author = $postInput['user'];
        $tags = $postInput['tags'];
        $postData = [
            'title' => $postInput['title'] ?? '',
            'slug' => createSlug($postInput['title']),
            'description' => getCharactersWithOutHTMLTags($content, self::DESCRIPTION_LENGTH) . '...',
            'content' => $content,
            'thumbnail' => $thumb,
            'category' => $this->categoryService->getCategory($categoryId)->first()->toArray(),
            'author' => [
                'slug' => 'admin',
                'name' => 'Admin'
            ],
            'tags' => $this->tagService->addSlugTag($tags),
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