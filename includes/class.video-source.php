<?php

namespace Snap_Video_Gallery;

class Video_Source
{
    protected $id;

    protected $type;

    protected $url;

    protected $sources = [
        [
            'type' => 'youtube',
            'pattern' => '/(?<=v=|v\/|vi=|vi\/|youtu.be\/)[a-zA-Z0-9_-]{11}/',
        ],
        [
            'type' => 'vimeo',
            'pattern' => '/https:\/\/vimeo\.com\/([0-9]+)/',
        ],
    ];

    public function __construct($url)
    {
        $this->url = $url;

        $this->init();
    }

    public function id()
    {
        return $this->id;
    }

    public function player_url()
    {
        switch ($this->type()) {
            case 'vimeo':
                return "https://player.vimeo.com/video/{$this->id()}?byline=0&portrait=0&title=0";

            case 'youtube':
                return "https://www.youtube.com/embed/{$this->id()}";
        }
    }

    public function type()
    {
        return $this->type;
    }

    protected function init()
    {
        foreach ($this->sources as $source) {
            preg_match($source['pattern'], $this->url, $match);

            if (count($match)) {
                $this->id = end($match);
                $this->type = $source['type'];
                return;
            }
        }
    }
}