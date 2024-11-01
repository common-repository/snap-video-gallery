<?php

namespace Snap_Video_Gallery;

class Video_Taxonomy
{
    protected $default_slug = 'default';

    protected $taxonomy = 'snap_category';

    public static function register()
    {
        $video_taxonomy = new static;

        add_action('init', [$video_taxonomy, 'register_taxonomy']);
    }

    public function assign_default($post_id)
    {
        $term = $this->get_default() ?: $this->create_default();

        wp_set_post_terms($post_id, $term->term_id, $this->taxonomy());
    }

    public function create_default()
    {
        return wp_insert_term('Default', $this->taxonomy(), [
            'slug' => $this->default_slug(),
        ]);
    }

    public function default_slug()
    {
        return $this->default_slug;
    }

    public function get_default()
    {
        return get_term_by('slug', $this->default_slug(), $this->taxonomy());
    }

    public function register_taxonomy()
    {
        $args = [
            'capabilities' => ['manage_categories'],
            'hierarchical' => true,
            'labels' => [
                'name' => 'Video Categories',
                'singular_name' => 'Video Category',
            ],
             'meta_box_cb' => false,
            'public' => false,
        ];

        register_taxonomy($this->taxonomy(), (new Video_Post)->type(), $args);
    }

    public function taxonomy()
    {
        return $this->taxonomy;
    }
}