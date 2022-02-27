<?php

namespace App\Exceptions;

use Throwable;
use App\Traits\ApiResponses;
use Psy\Exception\FatalErrorException;
use Illuminate\Database\QueryException;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\Debug\Exception\FatalThrowableError;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class Handler extends ExceptionHandler
{
    use ApiResponses;
    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
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


    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Throwable  $exception
     *
     * @return \Symfony\Component\HttpFoundation\Response|\Illuminate\Http\JsonResponse
     *
     * @throws \Throwable
     */
    public function handleException(Throwable $exception, $request)
    {
        if ($exception instanceof NotFoundHttpException) {
            return $this->notFoundAlert('We cannot access this resource you\'re looking for', 'resource_not_found');
        }

        if ($exception instanceof ModelNotFoundException) {
            return $this->notFoundAlert('Unable to locate model resource', 'model_not_found');
        }

        if ($exception instanceof HttpException) {
            return $this->httpErrorAlert($exception->getMessage(), $exception);
        }

        if ($exception instanceof FatalThrowableError) {
            return $this->serverErrorAlert('An error occurred processing your request, Try again later... ', $exception);
        }

        if ($exception instanceof FatalErrorException) {
            return $this->serverErrorAlert('An error occurred processing your request, Try again later... ', $exception);
        }

        if ($exception instanceof ValidationException) {
            return $this->formValidationErrorAlert($exception->errors());
        }

        if ($exception instanceof QueryException) {
            return $this->serverErrorAlert('There is a fatal query error', $exception);
        }

        return $this->serverErrorAlert('An error occurred processing your request, Try again later... ', $exception);
    }
}
