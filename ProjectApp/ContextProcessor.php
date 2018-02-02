<?php

namespace ProjectApp;

class ContextProcessor
{
    private $output = array();
    
    public function process($uri)
    {
        $parts = explode('/', $uri);
        
        if (sizeof($parts) > 1)
        {
            //
            $service = 'ProjectApp\\Controllers\\'.ucwords($parts[0]);
            //.'\\'.ucwords($parts[1]);
            $serviceObj = new $service;
           // print_r($serviceObj);die();
            
            if ($serviceObj instanceof ContextProcessorServiceAbstract)
            {
                unset($parts[0]);
                $uriParts = explode('/', implode('/', $parts));
                $serviceObj->setUriParts($uriParts);
                $serviceObj->execute();
                $this->output = $serviceObj->getOutputAsArray();
            }
        }
    }
    
    public function getOutputAsArray()
    {
        return $this->output;
    }
}