<?php
namespace App\Services;

class TagService
{

    public function create($data)
    {
        return auth()->user()->tags()->create($data);
    }

    public function update($tag, $data)
    {
        $tag->update($data);
        return $tag;
    }

    public function delete($tag)
    {
        $tag->delete();
    }

    public function getTags()
    {
        return auth()->user()->tags;
    }

    public function getTag($tag)
    {
        return $tag;
    }
}