<?php

/**
 * @var $this \Snap_Video_Gallery\Template
 * @var $display array
 */

if (
    !array_key_exists('videos', $display) ||
    !$display['videos']
) {
    return;
}

$rows = array_chunk($display['videos'], $display['columns']);

?>
<div class="snap-gallery snap-cols-<?php echo esc_attr($display['columns']); ?>">
    <?php foreach ($rows as $row) : ?>
        <?php foreach ($row as $video) : ?>
            <?php echo $this->render('video.php', ['video' => $video]); ?>
        <?php endforeach; ?>
    <?php endforeach; ?>
</div>
