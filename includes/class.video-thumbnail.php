<?php

namespace Snap_Video_Gallery;

class Video_Thumbnail
{
    protected $source;

    protected $url;

    public function __construct($video_url)
    {
        $this->source = new Video_Source($video_url);
    }

    public function url()
    {
        if (is_null($this->url)) {
            $this->url = $this->load_url();
        }

        return $this->url;
    }

    protected function load_url()
    {
        switch ($this->source->type()) {
            case 'vimeo':
                return $this->load_vimeo_url();

            case 'youtube':
                return "https://i.ytimg.com/vi/{$this->source->id()}/hqdefault.jpg";
        }
    }

    protected function load_vimeo_url()
    {
        $response = wp_remote_get("https://vimeo.com/api/v2/video/{$this->source->id()}.json");

        if (
            !is_array($response) ||
            !array_key_exists('body', $response)
        ) {
            return;
        }

        $decoded = json_decode($response['body'], $associative = true);

        if (
            is_array($decoded) &&
            array_key_exists(0, $decoded) &&
            array_key_exists('thumbnail_large', $decoded[0])
        ) {
            return $decoded[0]['thumbnail_large'];
        }
    }
}