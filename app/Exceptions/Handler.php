<?php

namespace App\Exceptions;

use App\Traits\ApiResponser;
use ErrorException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    use ApiResponser;
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

        $this->renderable(function(MethodNotAllowedHttpException $e){
            return $this->setResponse(405, false, 'Method Not Allowed');
        });

        $this->renderable(function(ErrorException $e){
            return $this->setResponse(500, false, 'Unexpected error, please try again later');
        });
    }
}
