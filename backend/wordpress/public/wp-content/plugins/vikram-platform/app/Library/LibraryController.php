<?php

declare(strict_types=1);

namespace ProjectVikram\Library;

final class LibraryController
{
    public function index(): array
    {
        $categories = get_categories([
            'hide_empty' => true,
            'orderby'    => 'name',
            'order'      => 'ASC',
        ]);

        $library = [];

        foreach ($categories as $category) {

            $library[] = [
                'id'          => $category->term_id,
                'name'        => $category->name,
                'slug'        => $category->slug,
                'description' => category_description($category->term_id),
                'chapters'    => $category->count,
            ];
        }

        return json_decode(
            json_encode(
                $library,
                JSON_UNESCAPED_UNICODE
            ),
            true
        );
    }
}