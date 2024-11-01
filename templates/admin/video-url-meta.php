<?php

/**
 * @var $this \Snap_Video_Gallery\Template
 * @var $display array
 */

use Snap_Video_Gallery\Embedded_Video;

?>
<label for="videourl-meta-box">Enter the URL of your video:</label>
<input id="videourl-meta-box"
       name="<?php echo esc_attr($display['name']); ?>"
       type="text"
       size="40"
       value="<?php echo esc_attr($display['value']); ?>"
       placeholder="https://vimeo.com/454500236"
>
<?php if ($display['value']) : ?>
    <div class="snap-video-preview">
        <?php echo (new Embedded_Video($display['post']))->player(); ?>
    </div>

    <style>
        .snap-video-preview {
            margin-top: 20px;
        }

        .snap-video-preview iframe {
            aspect-ratio: 16 / 9;
            width: 100%;
        }
    </style>
<?php endif; ?>
