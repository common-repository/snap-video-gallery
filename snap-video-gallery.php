<?php

/*
Plugin Name: Snap Video Gallery
Description: Easy-to-use video gallery that enables you to insert a gallery of videos into a page or post.
Version: 1.0.0
Author: Site Steward
Author URI: https://site-steward.com/
*/

if (!defined('ABSPATH')) {
    exit;
}

if (!defined('SNAP_VIDEO_GALLERY_PATH')) {
    define('SNAP_VIDEO_GALLERY_PATH', plugin_dir_path(__FILE__));
}

if (!defined('SNAP_VIDEO_GALLERY_URL')) {
    define('SNAP_VIDEO_GALLERY_URL', plugin_dir_url(__FILE__));
}

require_once __DIR__ . '/includes/autoloader.php';

\Snap_Video_Gallery\Admin_Menu::register();
\Snap_Video_Gallery\Assets::register();
\Snap_Video_Gallery\Block::register();
\Snap_Video_Gallery\Shortcode::register();
\Snap_Video_Gallery\Video_Post::register();
\Snap_Video_Gallery\Video_Taxonomy::register();
