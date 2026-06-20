<?php

declare(strict_types=1);

namespace ProjectVikram\Novel;

use WP_REST_Request;

final class Api
{
    public function register(): void
    {
        register_rest_route(
            'vikram/v1',
            '/novel/(?P<slug>[a-zA-Z0-9-]+)',
            [
                'methods'             => 'GET',
                'callback'            => [$this, 'show'],
                'permission_callback' => '__return_true',
            ]
        );
    }

    public function show(WP_REST_Request $request)
    {
        return rest_ensure_response(
            (new NovelController())->show(
                $request['slug']
            )
        );
    }
}