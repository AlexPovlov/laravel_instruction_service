<?php

namespace App\Providers;

use Illuminate\Support\Facades\Response;
use Illuminate\Support\ServiceProvider;

class CustomResponseServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        Response::macro('success', function ($data = [], $message = "Успешно") {
            return response()->json([
                'data' => $data,
                'success' => true,
                'message' => $message
            ]);
        });

        Response::macro('error', function ($error = [], $message = "Ошибка", $status = 500) {
            return response()->json([
                'error' => $error,
                'success' => false,
                'message' => $message
            ], $status);
        });
    }
}
