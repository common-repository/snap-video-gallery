<?php

namespace Snap_Video_Gallery;

use WP_Query;

class Video_Post
{
    protected $post_type = 'snap-video';

    protected $thumbnail_meta_key = '_snap_video_thumbnail';

    protected $url_meta_key = '_snap_video_url';

    protected $url_nonce_key = 'snap_video_url_meta_nonce';

    public static function register()
    {
        $video_post = new static;

        add_action('init', [$video_post, 'register_post_type']);
        add_action('add_meta_boxes', [$video_post, 'register_post_meta']);
        add_action("save_post_{$video_post->type()}", [$video_post, 'save_video_post']);
    }

    public function load_video_thumbnail($post_id)
    {
        return get_post_meta($post_id, $this->thumbnail_meta_key, $single = true);
    }

    public function save_video_thumbnail($post_id, $video_url)
    {
        $thumbnail = new Video_Thumbnail($video_url);

        return update_post_meta($post_id, $this->thumbnail_meta_key, sanitize_url($thumbnail->url()));
    }

    public function load_video_url($post_id)
    {
        return get_post_meta($post_id, $this->url_meta_key, $single = true);
    }

    public function save_video_url($post_id, $url)
    {
        return update_post_meta($post_id, $this->url_meta_key, sanitize_url($url));
    }

    public function load_all()
    {
        $query = new WP_Query([
            'post_status' => 'publish',
            'post_type' => $this->type(),
            'posts_per_page' => -1,
        ]);

        return array_map([$this, 'add_video_url'], $query->get_posts());
    }

    public function register_post_meta()
    {
        add_meta_box(
            'snap_video_gallery_url_meta_box',
            'Video URL',
            [$this, 'render_video_url_meta_box'],
            $this->type()
        );
    }

    public function register_post_type()
    {
        register_post_type($this->type(), [
            'delete_with_user' => false,
            'has_archive' => true,
            'labels' => [
                'name' => __('Videos'),
                'singular_name' => __('Video'),
            ],
            'show_in_menu' => (new Admin_Menu)->menu_slug(),
            'show_ui' => true,
            'supports' => ['title'],
        ]);
    }

    public function render_video_url_meta_box($post)
    {
        wp_nonce_field(basename(__FILE__), $this->url_nonce_key);

        echo Template::render('admin/video-url-meta.php', [
            'post' => $this->add_video_url($post),
            'name' => $this->url_meta_key,
            'value' => $this->load_video_url($post->ID),
        ]);
    }

    public function save_video_post($post_id)
    {
        if (wp_is_post_autosave($post_id) || wp_is_post_revision($post_id)) {
            return;
        }

        if ($video_url = $this->video_url_from_request()) {
            $this->save_video_url($post_id, $video_url);
            $this->save_video_thumbnail($post_id, $video_url);
            (new Video_Taxonomy)->assign_default($post_id);
        }
    }

    public function type()
    {
        return $this->post_type;
    }

    protected function add_video_url($post)
    {
        $post->url = $this->load_video_url($post->ID);

        return $post;
    }

    protected function video_url_from_request()
    {
        if (
            array_key_exists($this->url_nonce_key, $_POST) &&
            wp_verify_nonce($_POST[$this->url_nonce_key], basename(__FILE__)) &&
            array_key_exists($this->url_meta_key, $_POST)
        ) {
            return sanitize_url($_POST[$this->url_meta_key]);
        }

        return false;
    }
}