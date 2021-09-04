<?php

namespace App\Repositories;

use App\Models\Tag;

class TagRepository extends AbstractRepository
{
    public function __construct()
    {
        $this->model = new Tag();
    }
}
