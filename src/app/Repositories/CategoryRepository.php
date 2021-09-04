<?php

namespace App\Repositories;

use App\Models\Category;

class CategoryRepository extends AbstractRepository
{
    public function __construct()
    {
        $this->model = new Category();
    }
}
