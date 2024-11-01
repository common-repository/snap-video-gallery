<?php

/**
 * @var $this \Snap_Video_Gallery\Template
 * @var $display array
 * @var $video \Snap_Video_Gallery\Embedded_Video
 */

$video = $display['video'];

?>
<iframe src="<?php echo esc_url($video->url()); ?>"
        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
        allowfullscreen
        frameborder="0"
></iframe>
