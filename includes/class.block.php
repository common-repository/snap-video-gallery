<?php

namespace Snap_Video_Gallery;

class Block
{
    public static function register()
    {
        $block = new static;

        add_action('init', [$block, 'register_block_type']);
        add_action('enqueue_block_editor_assets', [$block, 'enqueue_assets']);
    }

    public function enqueue_assets()
    {
        wp_enqueue_script(
            $handle = 'snap-video-gallery-block',
            $src = SNAP_VIDEO_GALLERY_URL . 'assets/snap-gallery-block.js',
            $deps = ['wp-blocks', 'wp-editor', 'wp-element']
        );

        wp_enqueue_style(
            $handle = 'snap-video-gallery-style',
            $src = SNAP_VIDEO_GALLERY_URL . 'assets/snap-video-gallery.css',
            $deps = []
        );
    }

    public function register_block_type()
    {
        register_block_type('snap-video-gallery/gallery', [
            'attributes' => [
                'columns' => [
                    'default' => 2,
                    'type' => 'integer',
                ],
            ],
            'render_callback' => [new Shortcode(), 'display'],
        ]);
    }
}