<?php

namespace Snap_Video_Gallery;

class Footer
{
    protected static $instance;

    protected $content = [];

    protected $hook_registered = false;

    /**
     * @return Footer
     */
    public static function instance()
    {
        if (is_null(static::$instance)) {
            static::$instance = new static;
        }

        return static::$instance;
    }

    public function push($content)
    {
        $this->content[] = $content;

        $this->maybe_register_hook();
    }

    public function render()
    {
        echo implode(PHP_EOL, $this->content);
    }

    protected function maybe_register_hook()
    {
        if ($this->hook_registered) {
            return;
        }

        add_action('wp_footer', [$this, 'render'], 100);

        $this->hook_registered = true;
    }
}