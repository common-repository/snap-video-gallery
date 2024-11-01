<?php

namespace Snap_Video_Gallery;

class Admin_Menu
{
    protected $menu_slug = 'snap-video-gallery';

    public static function register()
    {
        $admin_menu = new static;

        add_action('admin_menu', [$admin_menu, 'add_menu_page']);
        add_action('admin_menu', [$admin_menu, 'add_settings_page']);
    }

    public function add_menu_page()
    {
        add_menu_page(
            'Snap Gallery',
            'Snap Gallery',
            'manage_options',
            $this->menu_slug(),
            '',
            'dashicons-playlist-video',
            11
        );
    }

    public function add_settings_page()
    {
        add_submenu_page(
            $this->menu_slug(),
            'Snap Video Gallery Settings',
            'Settings',
            'manage_options',
            'snap-video-gallery-settings',
            [$this, 'render_settings_page']
        );
    }

    public function render_settings_page()
    {
        if (current_user_can('manage_options')) {
            echo Template::render('admin/settings.php');
        }
    }

    public function menu_slug()
    {
        return $this->menu_slug;
    }
}