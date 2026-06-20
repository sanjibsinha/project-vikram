<?php

declare(strict_types=1);

namespace ProjectVikram\Library;

use WP_REST_Request;
use WP_REST_Response;

final class Api
{
    public function register(): void
    {
        register_rest_route(
            'vikram/v1',
            '/library',
            [
                'methods' => 'GET',
                'callback' => [$this, 'index'],
                'permission_callback' => '__return_true',
            ]
        );
    }

    public function index(WP_REST_Request $request)
    {
        return rest_ensure_response(
            (new LibraryController())->index()
        );
    }
}