<?php

namespace Snap_Video_Gallery;

class Template
{
    public static function render($template, $display = null)
    {
        return (new static)->include($template, $display);
    }

    public function include($template, $display = null)
    {
        ob_start();

        include $this->path($template);

        return ob_get_clean();
    }

    protected function path($template)
    {
        return locate_template("snap-video-gallery/{$template}")
            ?: SNAP_VIDEO_GALLERY_PATH . "templates/{$template}";
    }
}