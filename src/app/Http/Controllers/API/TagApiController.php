<?php

namespace App\Http\Controllers\API;

use App\Exceptions\CustomQueryException;
use App\Http\Requests\Tag\TagCreateRequest;
use App\Http\Requests\Tag\TagDeleteRequest;
use App\Http\Requests\Tag\TagDetailsRequest;
use App\Http\Requests\Tag\TagUpdateRequest;
use App\Http\Resources\TagResource;
use App\Services\TagService;
use App\Helpers\CustomResponse;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

class TagApiController extends Controller
{
    /**
     * @var TagService
     */
    private $tagService;

    public function __construct(TagService $faqService)
    {
        $this->tagService = $faqService;
    }

    /**
     * @return JsonResponse
     * @throws CustomQueryException
     */
    public function list(): JsonResponse
    {
        return CustomResponse::successResponse(__('success'),
            TagResource::collection($this->tagService->list()));
    }

    /**
     * @param TagCreateRequest $request
     * @return JsonResponse
     * @throws CustomQueryException
     */
    public function create(TagCreateRequest $request): JsonResponse
    {
        return CustomResponse::successResponse(__('success'),
            new TagResource($this->tagService->create($request->validated())));
    }

    /**
     * @param TagDetailsRequest $request
     * @return JsonResponse
     * @throws CustomQueryException
     */
    public function details(TagDetailsRequest $request): JsonResponse
    {
        return CustomResponse::successResponse(__('success'),
            new TagResource($this->tagService->details($request->validated())));
    }

    /**
     * @param TagUpdateRequest $request
     * @return JsonResponse
     * @throws CustomQueryException
     */
    public function update(TagUpdateRequest $request): JsonResponse
    {
        return CustomResponse::successResponse(__('success'),
            new TagResource($this->tagService->update($request->validated())));
    }

    /**
     * @param TagDeleteRequest $request
     * @return JsonResponse
     * @throws CustomQueryException
     */
    public function delete(TagDeleteRequest $request): JsonResponse
    {
        $this->tagService->delete($request->validated());
        return CustomResponse::successResponse(__('success'));
    }
}
