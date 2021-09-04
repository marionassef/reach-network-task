<?php

namespace App\Http\Controllers\API;

use App\Exceptions\CustomQueryException;
use App\Http\Requests\Ad\AdListRequest;
use App\Http\Resources\AdResource;
use App\Services\AdService;
use App\Helpers\CustomResponse;
use App\Http\Controllers\Controller;
use Illuminate\Http\Client\Request;
use Illuminate\Http\JsonResponse;

class AdApiController extends Controller
{
    /**
     * @var AdService
     */
    private $adService;

    public function __construct(AdService $faqService)
    {
        $this->adService = $faqService;
    }

    /**
     * @return JsonResponse
     * @throws CustomQueryException
     */
    public function list(AdListRequest $request): JsonResponse
    {
        return CustomResponse::successResponse('success',
            AdResource::collection($this->adService->list($request->all())));
    }
}
