<?php

namespace App\Repositories;

use App\Models\Ad;

class AdRepository extends AbstractRepository
{
    public function __construct()
    {
        $this->model = new Ad();
    }

    public function search($data){
        $queryModel = $this->model->query()
            ->where('user_id', $data['advertiser_id']);

        if(isset($data['tag'])){
            $queryModel->whereHas('tags', function ($query) use($data) {
                return $query->where('name', $data['tag']);
            });
        }
        if(isset($data['category'])){
            $queryModel->whereHas('category', function ($query) use($data) {
                return $query->where('name', $data['category']);
            });
        }
        return $queryModel->get();
    }
}
