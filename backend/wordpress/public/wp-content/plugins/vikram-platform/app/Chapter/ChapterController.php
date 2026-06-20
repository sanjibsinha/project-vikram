<?php

declare(strict_types=1);

namespace ProjectVikram\Chapter;

final class ChapterController
{
    public function show(int $id): array
    {
        $post = get_post($id);

        if (! $post || $post->post_type !== 'post') {
            return [
                'error' => 'Chapter not found',
            ];
        }

        setup_postdata($post);

        $previous = get_previous_post(true);
        $next = get_next_post(true);

        $chapter = [
            'id'        => $post->ID,
            'title'     => get_the_title($post),
            'slug'      => $post->post_name,
            'content'   => apply_filters('the_content', $post->post_content),
            'thumbnail' => get_the_post_thumbnail_url($post->ID, 'large'),
            'date'      => get_the_date('c', $post),
            'previous'  => $previous ? [
                'id'    => $previous->ID,
                'title' => $previous->post_title,
            ] : null,
            'next'      => $next ? [
                'id'    => $next->ID,
                'title' => $next->post_title,
            ] : null,
        ];

        wp_reset_postdata();

        return $chapter;
    }
}