<?php 

namespace App\Services;

use App\Repositories\Tag\TagRepository;

class TagService {
    public function __construct(private TagRepository $tagRepo) {}

    public function addNewTagIfExist(array $tags) {
        return $this->addMultipleTags($this->getTagsNotExist($tags));
    }

    public function addMultipleTags(array $tags) {
        return $this->tagRepo->insert($tags);
    }

    public function getTagsNotExist(array $tags) {
        $tagsExist = $this->tagRepo->findMultiple('slug', array_column($tags, 'name'));
        if (!$tagsExist) {
            return $tags;
        }

        $tagMap = [];
        foreach ($tagsExist as $tag) {
            $tagMap[$tag['name']] = 1;
        }

        if (count($tagMap) <= 1) {
            return $tags;
        }

        $tagDiff = [];
        foreach ($tags as $tag) {
            if (!isset($tagMap[$tag['value']])) {
                array_push($tagDiff, $tag);
            }
        }

        if (count($tagDiff) < 1) {
            return $tags;
        }
        return $tagDiff;
    }
}