<?php

// set response header to be JSON type
// with character set UTF-8
header('Content-Type: application/json; charset=UTF-8');

$xhr = isset($_SERVER['HTTP_X_REQUESTED_WITH']) ? strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) :  null;
//var_dump($xhr) ;die();
if ($xhr === 'xmlhttprequest')
{
    // param uri passed by .htaccess
    $uri = isset($_GET['uri']) ? $_GET['uri'] : '';

    // if uri exists
    if ($uri)
    {
        include __DIR__ .'/autoload.php';
        $cp = new ProjectApp\ContextProcessor();
        $cp->process($uri);
        echo json_encode($cp->getOutputAsArray());
    }
    else
    {
        echo json_encode(array('error'=>'Illegal request!!!!!'));
    }
}
else
{
    echo json_encode(array('error'=>'Illegal request '));
   // echo "hello";
}