<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpsertPostRequest;
use App\Http\Resources\PostResource;
use App\Services\PostService;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function __construct(private PostService $post) {
    }

    public function index() {

    }

    public function store(UpsertPostRequest $request) {
        return PostResource::make($this->post->createPost($request));
    }
}
