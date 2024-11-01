<?php

/**
 * @var $this \Snap_Video_Gallery\Template
 * @var $display array
 * @var $video \Snap_Video_Gallery\Embedded_Video
 */

$video = $display['video'];

?>

<div class="snap-video" data-snap_handle="<?php echo esc_attr($video->handle()); ?>">
    <div class="snap-modal-trigger">
        <div class="snap-thumbnail">
            <div class="snap-thumbnail-bg"
                 style="background-image: url('<?php echo $video->thumbnail(); ?>');"
            ></div>
        </div>
    </div>

    <?php $video->place_modal_at_end_of_document(); ?>
</div>