<?php


namespace Services;


use App\Models\tag;
use Services\interfaces\TagRepository;

class TagRepositoryImpl implements TagRepository
{

    public function create(array $data)
    {
        $tag = new tag();
        foreach ($data as $key => $value)
            $tag->$key = $value;
        $tag->save();
        return $tag;
    }

    public function update(tag $tag, $data)
    {
        foreach ($data as $key => $value)
            $tag->$key = $value;
        $tag->save();
        return $tag;
    }

    public function delete(tag $tag)
    {
        $tag->delete();
        return $tag;
    }
}
