<?php

namespace Snap_Video_Gallery;

class Shortcode
{
    protected $columns_min = 2;

    protected $columns_max = 3;

    protected $default_attrs = [
        'category' => 'default',
        'columns' => 2,
    ];

    protected $shortcode = 'snap-video-gallery';

    public static function register()
    {
        $shortcode = new static;

        add_action('init', [$shortcode, 'add']);
    }

    public function add()
    {
        add_shortcode($this->snippet(), [$this, 'display']);
    }

    public function display($attrs)
    {
        $attrs = shortcode_atts($this->default_attrs, $attrs, $this->snippet());

        return Template::render('gallery.php', [
            'columns' => $this->force_columns_to_allowed_range($attrs['columns']),
            'videos' => $this->load_video_posts_as_embedded_video(),
        ]);
    }

    public function snippet()
    {
        return $this->shortcode;
    }

    protected function force_columns_to_allowed_range($columns)
    {
        return max($this->columns_min, min($this->columns_max, $columns));
    }

    protected function load_video_posts_as_embedded_video()
    {
        $video_post = new Video_Post;

        return array_map(function ($video_post) {
            return new Embedded_Video($video_post);
        }, $video_post->load_all());
    }
}