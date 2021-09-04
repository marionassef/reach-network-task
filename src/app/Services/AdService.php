<?php

namespace App\Services;

use App\Exceptions\CustomQueryException;
use App\Repositories\AdRepository;

class AdService
{
    /**
     * @var AdRepository
     */
    private $adRepository;

    public function __construct(AdRepository $repository)
    {
        $this->adRepository = $repository;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function list($data)
    {
        return $this->adRepository->search($data);
    }
}
