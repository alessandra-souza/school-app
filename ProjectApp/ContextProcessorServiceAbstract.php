<?php

namespace ProjectApp;

abstract class ContextProcessorServiceAbstract
{
    protected $output = array();

    abstract public function setUriParts(array $uriParts);
    
    abstract public function execute();
    
    public final function getOutputAsArray()
    {
        return $this->output;
    }
}