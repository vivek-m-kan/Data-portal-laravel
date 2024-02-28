<?php

namespace App\Exceptions;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

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

    protected $version = "v1";

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->renderable(function (NotFoundHttpException $e, $request) {
            if ($request->is('api/*')) {
                return response()->json([
                    'message' => $this->getMessage($request)
                ], Response::HTTP_NOT_FOUND);
            }
        });
    }

    public function getMessage($request) : string {
        $message = "Not found";
        if($request->is("api/$this->version/campaigns/*")) $message = "The campaign could not be found";

        if($request->is("api/$this->version/clients/*")) $message = "The client could not be found";

        if($request->is("api/$this->version/leads/*")) $message = "The lead could not be found";

        return $message;
    }
}
