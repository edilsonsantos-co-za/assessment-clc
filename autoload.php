<?php

spl_autoload_register(function ($class) {
    // Convert class name to file path
    $file = __DIR__ . '/' . str_replace('\\', '/', $class) . '.php';
    // Check if the file exists
    if (file_exists($file)) {
        include_once $file;
    }
});
