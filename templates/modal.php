<?php

/**
 * @var $this \Snap_Video_Gallery\Template
 * @var $display array
 * @var $video \Snap_Video_Gallery\Embedded_Video
 */

$video = $display['video'];

?>
<div id="<?php echo esc_attr($video->handle()); ?>" class="snap-modal">
    <div class="snap-modal-content">
        <span class="snap-modal-close">×</span>

        <?php echo $video->player(); ?>
    </div>
</div>
