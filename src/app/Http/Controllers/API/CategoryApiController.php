<?php

namespace App\Http\Controllers\API;

use App\Exceptions\CustomQueryException;
use App\Http\Requests\Category\CategoryCreateRequest;
use App\Http\Requests\Category\CategoryDetailsRequest;
use App\Http\Requests\Category\CategoryUpdateRequest;
use App\Http\Requests\Category\CategoryDeleteRequest;
use App\Http\Resources\CategoryResource;
use App\Services\CategoryService;
use App\Helpers\CustomResponse;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

class CategoryApiController extends Controller
{
    /**
     * @var CategoryService
     */
    private $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    /**
     * @return JsonResponse
     * @throws CustomQueryException
     */
    public function list(): JsonResponse
    {
        return CustomResponse::successResponse(__('success'),
            CategoryResource::collection($this->categoryService->list()));
    }

    /**
     * @param CategoryCreateRequest $request
     * @return JsonResponse
     * @throws CustomQueryException
     */
    public function create(CategoryCreateRequest $request): JsonResponse
    {
        return CustomResponse::successResponse(__('success'),
            new CategoryResource($this->categoryService->create($request->validated())));
    }

    /**
     * @param CategoryDetailsRequest $request
     * @return JsonResponse
     * @throws CustomQueryException
     */
    public function details(CategoryDetailsRequest $request): JsonResponse
    {
        return CustomResponse::successResponse(__('success'),
            new CategoryResource($this->categoryService->details($request->validated())));
    }

    /**
     * @param CategoryUpdateRequest $request
     * @return JsonResponse
     * @throws CustomQueryException
     */
    public function update(CategoryUpdateRequest $request): JsonResponse
    {
        return CustomResponse::successResponse(__('success'),
            new CategoryResource($this->categoryService->update($request->validated())));
    }

    /**
     * @param CategoryDeleteRequest $request
     * @return JsonResponse
     * @throws CustomQueryException
     */
    public function delete(CategoryDeleteRequest $request): JsonResponse
    {
        $this->categoryService->delete($request->validated());
        return CustomResponse::successResponse(__('success'));
    }
}
