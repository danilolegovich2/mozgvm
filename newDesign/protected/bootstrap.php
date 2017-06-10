<?php

ini_set('display_errors', 'on');

if (version_compare(phpversion(), '5.4.0', '<')) {
    die('Minimal required php version 5.4.0.');
}

if (!function_exists('finfo_open')) {
    die('PHP module fileinfo is required!');
}

require_once __DIR__ . '/inc/func.php';