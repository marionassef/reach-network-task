<?php

namespace App\Exceptions;

use App\Helpers\CustomResponse;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Request;
use Illuminate\Validation\UnauthorizedException;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    public function report(Throwable $exception)
    {
        if ($this->shouldReport($exception) && app()->bound('sentry')) {
            app('sentry')->captureException($exception);
        }

        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param Request $request
     * @param Throwable $exception
     * @return Response
     * @throws Throwable
     */
    public function render($request, Throwable $exception): Response
    {
        if ($exception instanceof CustomQueryException) {
            return CustomResponse::errorResponse('Something went wrong, please contact our customer support', 500);
        }
        if ($exception instanceof QueryException) {
            return CustomResponse::errorResponse('Something went wrong, please contact our customer support', 500);
        }
        if ($exception instanceof NotFoundHttpException) {
            return CustomResponse::errorResponse($exception->getMessage());
        }
        if ($exception instanceof CustomValidationException) {
            if($exception->getError()){
                return CustomResponse::errorResponse($exception->getMessage(), 400, $exception->getError());
            }
            return CustomResponse::errorResponse($exception->getMessage());
        }
        if ($exception instanceof ValidationException) {
            return CustomResponse::errorResponse($exception->validator->errors()->first());
        }
        if ($exception instanceof ModelNotFoundException) {
            return CustomResponse::errorResponse("No data found");
        }
        if ($exception instanceof MethodNotAllowedHttpException) {
            return CustomResponse::errorResponse('Wrong Request', 405);
        }
        if ($exception instanceof HttpException) {
            return CustomResponse::errorResponse($exception->getMessage());
        }
        if ($exception instanceof AuthenticationException) {
            return CustomResponse::errorResponse($exception->getMessage(), 401);
        }
        if ($exception instanceof UnauthorizedException) {
            return CustomResponse::errorResponse($exception->getMessage(), 401);
        }
        return parent::render($request, $exception);
    }
}
