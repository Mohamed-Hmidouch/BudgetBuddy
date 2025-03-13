<?php
namespace App\Services;
use App\Models\Api\Tag;
class TagService
{

    public function getTags()
    {
        return Tag::all();
    }
    public function getTag($id)
    {
        return Tag::find($id);
    }
    
    public function createTag($data)
    {
        return Tag::create($data);
    }

    public function updateTag($id,$data)
    {
        $tag = $this->getTag($id);
        $tag->update($data);
        $tag->save();
        return $tag;
    }
    public function delete($id)
    {
        $tag = $this->getTag($id);
        TagDetail::where('tag_id',$id)->delete();
        Review::where('tag_id',$id);
        $tag->imagable->delete();
        $tag->delete();
    }
}