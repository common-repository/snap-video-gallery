<?php

namespace Snap_Video_Gallery;

class Embedded_Video
{
    protected $handle;

    protected $source;

    protected $video;

    public function __construct($video)
    {
        $this->video = $video;
        $this->source = new Video_Source($this->get('url'));
    }

    public function get($property, $default = null)
    {
        if (in_array(strtolower($property), ['id', 'type'])) {
            return $this->source->{$property}();
        }

        if (strtolower($property) === 'post_id') {
            return $this->video->ID;
        }

        return $this->video->{$property} ?? $default;
    }

    public function handle()
    {
        if (is_null($this->handle)) {
            $this->handle = 'snap-' . bin2hex(random_bytes(8));
        }

        return $this->handle;
    }

    public function place_modal_at_end_of_document()
    {
        Footer::instance()->push($this->render('modal.php'));
    }

    public function player()
    {
        return $this->render('player.php');
    }

    public function url()
    {
        return $this->source->player_url();
    }

    public function thumbnail()
    {
        return (new Video_Post)->load_video_thumbnail($this->get('post_id'));
    }

    protected function render($template)
    {
        return Template::render($template, ['video' => $this]);
    }
}