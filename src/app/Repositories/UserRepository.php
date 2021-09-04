<?php

namespace App\Repositories;

use App\Exceptions\CustomQueryException;
use App\Models\User;
use Illuminate\Support\Facades\Schema;

class UserRepository extends AbstractRepository
{
    public function __construct()
    {
        $this->model = new User();
    }

    /**
     * @param $id
     * @throws CustomQueryException
     */
    public function hardDelete($id){
        Schema::disableForeignKeyConstraints();
        $item = $this->model->query()->where('id', $id)->withTrashed()->firstOrFail();
        $item->forceDelete();
        Schema::enableForeignKeyConstraints();
    }

    public function restoreUser($id)
    {
        $item = $this->model->query()->where('id', $id)->withTrashed()->firstOrFail();
        $item->restore();
    }
}
