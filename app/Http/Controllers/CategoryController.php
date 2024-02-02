<?php

namespace App\Http\Controllers;

use App\Services\CategoryService;
use App\Http\Requests\UpsertCategoryRequest;

class CategoryController extends Controller
{
    public function __construct(private CategoryService $categoryService) {
    }

    public function index() {
        return $this->categoryService->getAll();
    }

    public function store(UpsertCategoryRequest $request) {
        $categoryInput = $request->all();
        return $this->categoryService->createCategory($categoryInput);
    }
}
