<?php 

namespace App\Services;

use App\Repositories\Category\CategoryRepository;

class CategoryService {
    public function __construct(private CategoryRepository $categoryRepo) {}

    public function createCategory($categoryInput) {
        $categoryData = [
            'title' => $categoryInput['title'] ?? '',
            'status' => $categoryInput['status'] ?? 0,
            'parent_id' => null
        ];
        return $this->categoryRepo->create($categoryData);
    }

    public function getAll() {
        return $this->categoryRepo->all();
    }
}