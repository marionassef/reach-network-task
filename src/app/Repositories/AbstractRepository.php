<?php

namespace App\Repositories;

use App\Exceptions\CustomQueryException;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Log;

 class AbstractRepository implements AbstractRepositoryInterface
{
    public $model;

     /**
      * @throws \App\Exceptions\CustomQueryException
      */
     public function create($data)
    {
        try {
            return $this->model->query()->create($data);
        } catch (QueryException $exception) {
            Log::debug($exception);
            throw new CustomQueryException($exception->getMessage());
        }
    }

     /**
      * @throws \App\Exceptions\CustomQueryException
      */
     public function update($item, $data)
    {
        try {
            return $item->update($data);
        } catch (QueryException $exception) {
            Log::debug($exception);
            throw new CustomQueryException($exception->getMessage());
        }
    }

     /**
      * @throws \App\Exceptions\CustomQueryException
      */
     public function updateOrCreate($itemIfExist, $data)
    {
        try {
            return $this->model->query()->updateOrCreate($itemIfExist,$data);
        } catch (QueryException $exception) {
            Log::debug($exception);
            throw new CustomQueryException($exception->getMessage());
        }
    }

     /**
      * @throws \App\Exceptions\CustomQueryException
      */
     public function updateWhereIn($column , $value, $data)
    {
        try {
            return $this->model->query()->whereIn($column, $value)->update($data);
        } catch (QueryException $exception) {
            Log::debug($exception);
            throw new CustomQueryException($exception->getMessage());
        }
    }

     /**
      * @throws \App\Exceptions\CustomQueryException
      */
     public function findAll($filters = [], $with = [], $returnResults = true, $orderBy = 'created_at', $direction = 'DESC')
    {
        try {
            $query = $this->model->query()
                ->where($filters)
                ->with($with)
                ->orderBy($orderBy, $direction);

            return $returnResults ? $query->get() : $query;
        } catch (QueryException $exception) {
            Log::debug($exception);
            throw new CustomQueryException($exception->getMessage());
        }
    }

     /**
      * @throws \App\Exceptions\CustomQueryException
      */
     public function findAllByWhereIn($column , $value, $with = [], $returnResults = true, $orderBy = 'id', $direction = 'DESC')
    {
        try {
            $query = $this->model->query()
                ->whereIn($column, $value)
                ->with($with)
                ->orderBy($orderBy, $direction);

            return $returnResults ? $query->get() : $query;
        } catch (QueryException $exception) {
            Log::debug($exception);
            throw new CustomQueryException($exception->getMessage());
        }
    }

     /**
      * @throws \App\Exceptions\CustomQueryException
      */
     public function findOneByWhereIn($column , $value, $with = [])
    {
        try {
            return $this->model->query()
                ->whereIn($column, $value)
                ->with($with)->first();
        } catch (QueryException $exception) {
            Log::debug($exception);
            throw new CustomQueryException($exception->getMessage());
        }
    }

     /**
      * @throws \App\Exceptions\CustomQueryException
      */
     public function findAllByWhereNotIn($column , $value, $with = [], $returnResults = true, $orderBy = 'id', $direction = 'DESC')
    {
        try {
            $query = $this->model->query()
                ->whereNotIn($column, $value)
                ->with($with)
                ->orderBy($orderBy, $direction);

            return $returnResults ? $query->get() : $query;
        } catch (QueryException $exception) {
            Log::debug($exception);
            throw new CustomQueryException($exception->getMessage());
        }
    }

     /**
      * @throws \App\Exceptions\CustomQueryException
      */
     public function findAllWithPaging($filters = [], $with = [], $limit = 10, $offset = 0, $returnResults = true, $orderBy = 'id', $direction = 'DESC')
    {
        $limit = $limit ?? 10;
        $offset = $offset ?? 0;
        try {
            $query = $this->model->query()
                ->where($filters)
                ->with($with)
                ->orderBy($orderBy, $direction);

            return $returnResults ? $query->limit($limit)->offset($offset)->get() : $query;
        } catch (QueryException $exception) {
            Log::debug($exception);
            throw new CustomQueryException($exception->getMessage());
        }
    }

     /**
      * @throws \App\Exceptions\CustomQueryException
      */
     public function findOneBy($filters = [], $with = [])
    {
        try {
            return $this->model->query()->where($filters)->with($with)->first();
        } catch (QueryException $exception) {
            Log::debug($exception);
            throw new CustomQueryException($exception->getMessage());
        }
    }

     /**
      * @throws \App\Exceptions\CustomQueryException
      */
     public function findOneByOrFail($filters = [], $with = [])
    {
        try {
            return $this->model->query()->where($filters)->with($with)->firstOrFail();
        } catch (QueryException $exception) {
            Log::debug($exception);
            throw new CustomQueryException($exception->getMessage());
        }
    }

     /**
      * @throws \App\Exceptions\CustomQueryException
      */
     public function delete($id)
    {
        try {
            return $this->model->destroy($id);
        } catch (QueryException $exception) {
            Log::debug($exception);
            throw new CustomQueryException($exception->getMessage());
        }
    }

     /**
      * @throws \App\Exceptions\CustomQueryException
      */
     public function getItem($idOrModel)
    {
        try {
            return gettype($idOrModel) == 'object' ? $idOrModel : $this->model->find($idOrModel);
        } catch (QueryException $exception) {
            Log::debug($exception);
            throw new CustomQueryException('Something went wrong');
        }
    }

     /**
      * @throws \App\Exceptions\CustomQueryException
      */
     public function firstOrCreate($data)
    {
        try {
            return $this->model->query()->firstOrCreate($data);
        } catch (QueryException $exception) {
            Log::debug($exception);
            throw new CustomQueryException($exception->getMessage());
        }
    }

     /**
      * @throws \App\Exceptions\CustomQueryException
      */
     public function sync($item, $modelRelation, $data)
    {
        try {
            return $item->$modelRelation()->sync($data);
        } catch (QueryException $exception) {
            Log::debug($exception);
            throw new CustomQueryException($exception->getMessage());
        }
    }

     /**
      * @throws \App\Exceptions\CustomQueryException
      */
     public function deleteCollection($filters)
    {
        try {
            return $this->model->where($filters)->delete();
        } catch (QueryException $exception) {
            Log::debug($exception);
            throw new CustomQueryException($exception->getMessage());
        }
    }

}
