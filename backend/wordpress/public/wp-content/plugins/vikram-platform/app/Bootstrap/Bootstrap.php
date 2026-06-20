<?php

declare(strict_types=1);

namespace ProjectVikram\Bootstrap;
use ProjectVikram\Library\Api as LibraryApi;
use ProjectVikram\Novel\Api as NovelApi;
use ProjectVikram\Chapter\Api as ChapterApi;

use ProjectVikram\Home\Api;

final class Bootstrap
{
    public function boot(): void
    {
        add_action('rest_api_init', function () {
            (new \ProjectVikram\Home\Api())->register();
            (new LibraryApi())->register();
            (new NovelApi())->register();
            (new ChapterApi())->register();
        });
    }
}