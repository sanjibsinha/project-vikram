<?php

declare(strict_types=1);

namespace ProjectVikram\Novel;

final class NovelController
{
    public function show(string $slug): array
    {
        $category = get_category_by_slug($slug);

        if (! $category) {
            return [
                'error' => 'Novel not found',
            ];
        }

        $query = new \WP_Query([
            'post_type'      => 'post',
            'post_status'    => 'publish',
            'posts_per_page' => -1,
            'cat'            => $category->term_id,
            'orderby'        => 'date',
            'order'          => 'ASC',
        ]);

        $chapters = [];

        while ($query->have_posts()) {

            $query->the_post();

            $chapters[] = [
                'id'    => get_the_ID(),
                'title' => get_the_title(),
                'slug'  => get_post_field('post_name'),
                'date'  => get_the_date('Y-m-d'),
            ];
        }

        wp_reset_postdata();

        return [
            'id'          => $category->term_id,
            'title'       => $category->name,
            'slug'        => $category->slug,
            'description' => category_description($category->term_id),
            'chapters'    => $chapters,
        ];
    }
}