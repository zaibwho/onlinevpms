<?php

// Get the root URL dynamically
$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
$host = $_SERVER['HTTP_HOST'];
$root = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');

$path = $protocol . $host . $root;

$parentDir = dirname($root);

$parentpath = $protocol . $host . $parentDir;

?>