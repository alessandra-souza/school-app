<?php

spl_autoload_register(function($class){
    
    if(class_exists($class, false))
    {
        return;
    }
    
    $file = __DIR__ . '/' . str_replace('\\', '/', $class) . '.php';

    if($file && is_file($file))
    {
        require $file;
    }
});
