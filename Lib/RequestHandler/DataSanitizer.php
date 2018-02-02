<?php

namespace Lib\RequestHandler;

class DataSanitizer
{
    public static function sanitize(string $paramName, string $requestType)
    {
        if (strtoupper($requestType) === 'GET')
        {
            if (isset($_GET[$paramName]))
            {
                // bad -> sanitize it first
                return $_GET[$paramName];
            }
        }
        else if (strtoupper($requestType) === 'POST')
        {
            if (isset($_POST[$paramName]))
            {
                // bad -> sanitize it first
                return $_POST[$paramName];
            }
        }
        
        return null;
    }
}