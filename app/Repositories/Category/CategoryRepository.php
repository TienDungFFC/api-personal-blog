<?php

namespace App\Repositories\Category;

use App\Models\Category;
use App\Repositories\BaseRepository;

class CategoryRepository extends BaseRepository {
    public function __construct(Category $user) {
        parent::__construct($user);
    }
}