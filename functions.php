<?php

require_once __DIR__ . '/config.php';

function dd(...$var): never
{
    echo '<pre>';
    var_dump(...$var);
    echo '</pre>';
    die;
}

function asset($file): string
{
    $file = str_starts_with($file, '/') ? $file : '/' . $file;
    $uri = ROOT . '/assets' . $file;
    return $uri;
}
