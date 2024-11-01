<?php

namespace Snap_Video_Gallery;

class Assets
{
    protected $version = '1';

    public static function register()
    {
        $assets = new static;

        add_action('wp_enqueue_scripts', [$assets, 'enqueue']);
    }

    public function enqueue()
    {
        wp_enqueue_style(
            $handle = 'snap-video-gallery-style',
            $src = SNAP_VIDEO_GALLERY_URL . 'assets/snap-video-gallery.css',
            $deps = [],
            $this->version
        );

        wp_enqueue_script(
            $handle = 'snap-video-gallery-script',
            $src = SNAP_VIDEO_GALLERY_URL . 'assets/snap-video-gallery.js',
            $deps = [],
            $this->version
        );
    }
}