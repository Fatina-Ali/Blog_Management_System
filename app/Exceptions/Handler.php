<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
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
     */
    public function register(): void
    {
        // $this->renderable(function (AccessDeniedHttpException $e, $request) {
        //     return response()->json(['success'=>false, 'status'=>400,'data'=>[],'message'=> 'You are not allowed to access this page.'],400);
        // });

        // $this->renderable(function (NotFoundHttpException $e, $request) {
        //     return response()->json(['success'=>false, 'status'=>404,'data'=>[],'message'=> 'There is not an object with this ID'],404);
        // });
    }
}
