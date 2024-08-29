<?php

namespace App\Exceptions;

use App\Traits\RestResponse;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    use RestResponse;

    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->renderable(function (Throwable $exception, $request) {


            if ($exception instanceof AccessDeniedHttpException) {
                return $this->error($request->getPathInfo(), $exception, __('messages.forbidden'), Response::HTTP_FORBIDDEN);
            }

            if ($exception instanceof ModelNotFoundException) {
                $model = strtolower(class_basename($exception->getModel()));
                return $this->error($request->getPathInfo(), $exception,
                    __('messages.no-exist-instance', ['model' => $model]), Response::HTTP_NOT_FOUND);
            }

            if ($exception instanceof NotFoundHttpException) {
                return $this->error($request->getPathInfo(), $exception, __('messages.not-found-http'), Response::HTTP_NOT_FOUND);
            }

            if ($exception instanceof MethodNotAllowedHttpException) {
                return $this->error($request->getPathInfo(), $exception, __('messages.method-not-allowed'), Response::HTTP_METHOD_NOT_ALLOWED);
            }

            if ($exception instanceof AuthenticationException) {
               return $this->error($request->getPathInfo(), $exception, __('messages.no-credentials', [], config('app.locale')), Response::HTTP_UNAUTHORIZED);
            }
            if ($exception instanceof ValidationException) {
                $errors = $exception->validator->errors()->all();
                return $this->error($request->getPathInfo(), $exception, $errors, Response::HTTP_BAD_REQUEST);
            }

            if ($exception instanceof ClientException) {
                $message = $exception->getResponse()->getBody();
                $code = $exception->getCode();
                return $this->errorStr($message, $code);
            }

            if (config('app.debug')) {
                return $this->error($request->getPathInfo(), $exception, $exception->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
            }

            return $this->error($request->getPathInfo(), $exception, __('messages.internal-error'), Response::HTTP_INTERNAL_SERVER_ERROR);
        });
    }
}
