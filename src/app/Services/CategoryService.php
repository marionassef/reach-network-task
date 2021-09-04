<?php

namespace App\Services;

use App\Exceptions\CustomQueryException;
use App\Repositories\CategoryRepository;

class CategoryService
{
    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * @return mixed
     * @throws CustomQueryException
     */
    public function list()
    {
        return $this->categoryRepository->findAll([]);
    }

    /**
     * @param $data
     * @return mixed
     * @throws CustomQueryException
     */
    public function create($data)
    {
        return $this->categoryRepository->create($data);
    }

    /**
     * @param $data
     * @return mixed
     * @throws \App\Exceptions\CustomQueryException
     */
    public function details($data)
    {
        return $this->categoryRepository->findOneBy(['id'=> $data['id']]);
    }

    /**
     * @param $data
     * @return mixed
     * @throws CustomQueryException
     */
    public function update($data)
    {
        $item = $this->categoryRepository->findOneBy(['id'=> $data['id']]);
        $this->categoryRepository->update($item, $data);
        return $item;
    }

    /**
     * @param $id
     * @return mixed
     * @throws CustomQueryException
     */
    public function delete($id)
    {
        return $this->categoryRepository->delete($id);
    }
}
