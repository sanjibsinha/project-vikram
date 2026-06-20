<?php

declare(strict_types=1);

namespace ProjectVikram\Home;

use WP_REST_Request;
use WP_REST_Response;

final class Api
{
    public function register(): void
    {
        register_rest_route(
            'vikram/v1',
            '/home',
            [
                'methods' => 'GET',
                'callback' => [$this, 'home'],
                'permission_callback' => '__return_true',
            ]
        );

        register_rest_route(
            'vikram/v1',
            '/status',
            [
                'methods' => 'GET',
                'callback' => [$this, 'status'],
                'permission_callback' => '__return_true',
            ]
        );
    }

    public function home(WP_REST_Request $request)
    {
        return rest_ensure_response(
            (new HomeController())->index()
        );
    }

    public function status(WP_REST_Request $request)
    {
        return rest_ensure_response([
            'status'      => 'ok',
            'application' => 'Project Vikram',
            'version'     => '0.1.0',
        ]);
    }
}