<?php


namespace App\Repositories;


abstract class BaseRepository
{
    abstract public function create($request);

    abstract public function delete($id);
}
