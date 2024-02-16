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
        $tagsExist = $this->tagRepo->findMultiple('slug', array_column($tags, 'slug'))->get()->toArray();
        if (!$tagsExist) {
            return $tags;
        }

        $tagMap = [];
        foreach ($tagsExist as $tag) {
            $tagMap[$tag['slug']] = 1;
        }

        if (count($tagMap) == 0) {
            return $tags;
        }

        $tagDiff = [];
        foreach ($tags as $tag) {
            if (!isset($tagMap[$tag['slug']])) {
                array_push($tagDiff, $tag);
            }
        }

        if (count($tagDiff) == 0) {
            return [];
        }
        return $tagDiff;
    }

    public function addSlugTag(array $tags) {
        $newTag = [];
        foreach ($tags as $tag) {
            array_push($newTag, [
                'name' => $tag['value'],
                'slug' => createSlug($tag['value'])
            ]);
        }
        return $newTag;
    }
}