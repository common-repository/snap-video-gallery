<?php

spl_autoload_register(function ($classname) {
    $namespace = 'Snap_Video_Gallery\\';

    if (strpos($classname, $namespace) !== 0) {
        return;
    }

    $class = str_replace($namespace, '', $classname);
    $file = 'class.' . strtolower(str_replace('_', '-', $class)) . '.php';
    $path = SNAP_VIDEO_GALLERY_PATH . "/includes/{$file}";

    if (file_exists($path)) {
        include_once $path;
    }
});