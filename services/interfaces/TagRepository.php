<?php


namespace Services\interfaces;


use App\Models\tag;

interface TagRepository
{
    public function create(array $data);

    public function update(tag $tag, $data);

    public function delete(tag $tag);
}
