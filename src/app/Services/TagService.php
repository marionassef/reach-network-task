<?php

namespace App\Services;

use App\Exceptions\CustomQueryException;
use App\Repositories\TagRepository;

class TagService
{
    /**
     * @var TagRepository
     */
    private $tagRepository;

    public function __construct(TagRepository $repository)
    {
        $this->tagRepository = $repository;
    }

    /**
     * @return mixed
     * @throws CustomQueryException
     */
    public function list()
    {
        return $this->tagRepository->findAll([]);
    }

    /**
     * @param $data
     * @return mixed
     * @throws CustomQueryException
     */
    public function create($data)
    {
        return $this->tagRepository->create($data);
    }

    /**
     * @throws \App\Exceptions\CustomQueryException
     */
    public function details($data)
    {
        return $this->tagRepository->findOneBy(['id'=> $data['id']]);
    }

    /**
     * @param $data
     * @return mixed
     * @throws CustomQueryException
     */
    public function update($data)
    {
        $item = $this->tagRepository->findOneBy(['id'=> $data['id']]);
        $this->tagRepository->update($item, $data);
        return $item;
    }

    /**
     * @param $id
     * @return mixed
     * @throws CustomQueryException
     */
    public function delete($id)
    {
        return $this->tagRepository->delete($id);
    }
}
