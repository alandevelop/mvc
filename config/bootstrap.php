<?php

function dd($var)
{
    echo '<pre>';
    var_dump($var);
    echo '</pre>';
    die;
}

spl_autoload_register(function ($class) {
    $directories = [
        '/components',
        '/models',
        '/controllers'
    ];

    foreach ($directories as $dir) {
        $path = ROOT . "$dir/$class.php";
        if (file_exists($path)) {
            require_once $path;
            break;
        }
    }
});