<?php

namespace App\Repositories\Tag;

use App\Models\Tag;
use App\Repositories\BaseRepository;

class TagRepository extends BaseRepository {
    public function __construct(Tag $tag) {
        parent::__construct($tag);
    }
}