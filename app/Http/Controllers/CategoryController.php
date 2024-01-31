<?php

namespace App\Http\Controllers;

use App\Services\CategoryService;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function __construct(private CategoryService $categoryService) {
    }

    public function index() {
        return $this->categoryService->getAll();
    }

    public function store(Request $request) {
        $categoryInput = $request->all();
        return $this->categoryService->createCategory($categoryInput);
    }
}
