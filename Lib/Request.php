<?php

namespace Lib;

final class Request
{
    private static $pathInfo = null;
    
    public static function pathInfo()
    {
        if (self::$pathInfo === null) {
            self::$pathInfo = new PathInfo($_SERVER['REQUEST_URI']);


        }

        return self::$pathInfo;


    }
    
    public static function contentFile()
    {
        $contentFile = '';
        $uri = self::pathInfo()->getPath();
        // var_dump($uri); 
       
        ///api/students/add'
        
        
        if (!$uri || $uri === '/' || $uri === 'index') {
            $uri = 'home';
        }
        

        $contentFile = CONTENT_DIR . '/' . $uri . '.php';
        //var_dump($uri); 
       

        if (!file_exists($contentFile)) {
            $contentFile = CONTENT_DIR . '/404.php';
        }
        
        
        return $contentFile;

    }
}