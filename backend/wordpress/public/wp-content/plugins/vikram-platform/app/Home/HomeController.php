<?php

declare(strict_types=1);

namespace ProjectVikram\Home;

final class HomeController
{
    public function index(): array
    {
        return [
            'site' => [
                'name'        => get_bloginfo('name'),
                'description' => get_bloginfo('description'),
                'url'         => home_url('/'),
                'language'    => get_bloginfo('language'),
            ],
            'latest' => $this->latestChapters(),
        ];
    }

    private function latestChapters(): array
    {
        $query = new \WP_Query([
            'post_type'      => 'post',
            'post_status'    => 'publish',
            'posts_per_page' => 10,
        ]);

        $chapters = [];

        while ($query->have_posts()) {
            $query->the_post();

            $chapters[] = [
                'id'        => get_the_ID(),
                'title'     => get_the_title(),
                'slug'      => get_post_field('post_name'),
                'excerpt'   => get_the_excerpt(),
                'link'      => get_permalink(),
                'thumbnail' => get_the_post_thumbnail_url(get_the_ID(), 'medium'),
                'date'      => get_the_date('c'),
            ];
        }

        wp_reset_postdata();

        return $chapters;
    }
}