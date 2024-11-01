<?php

/**
 * @var $this \Snap_Video_Gallery\Template
 * @var $display array
 */

use Snap_Video_Gallery\Shortcode;

?>
<div class="wrap">
    <h1><?php echo esc_html(get_admin_page_title()); ?></h1>

    <h2>Generate Shortcode</h2>

    <p class="snap-shortcode-wrap">
        <span id="snap-shortcode"></span>
    </p>

    <p>
        <a href="#" id="snap-copy" class="button">Copy Shortcode</a>
        <span id="snap-status"></span>
    </p>

    <table class="form-table">
        <tbody>
        <tr>
            <th scope="row">Number of Columns</th>
            <td>
                <p>
                    <select name="number_of_columns">
                        <option value="2" selected>2 Columns</option>
                        <option value="3">3 Columns</option>
                    </select>
                </p>
            </td>
        </tr>
        </tbody>
    </table>
</div>

<script>
    var SnapGalleryShortcode = (function () {
        var shortcode = document.getElementById('snap-shortcode');
        var columns = document.querySelector('select[name=number_of_columns]');
        var copy = document.getElementById('snap-copy');
        var status = document.getElementById('snap-status');

        var updateShortcode = function () {
            shortcode.textContent = '[<?php echo esc_html((new Shortcode())->snippet()); ?> columns="' + columns.value + '"]';
        };

        columns.addEventListener('input', updateShortcode);

        copy.addEventListener('click', function (e) {
            e.preventDefault();
            try {
                navigator.clipboard.writeText(shortcode.textContent);
                status.innerText = 'Shortcode copied to clipboard!';
                setTimeout(function () {
                    status.innerText = '';
                }, 1500);
            } catch (error) {
                console.error('Failed to copy!', error);
            }
        });

        updateShortcode();
    })();
</script>

<style>
    .snap-shortcode-wrap {
        background-color: #fff;
        border-radius: 0.5rem;
        display: inline-block;
        padding: 0.75rem 1.5rem;
    }

    #snap-shortcode {
        font-size: 1.25rem;
        font-weight: bold;
    }

    #snap-status {
        margin-left: 0.5rem;
    }
</style>
