<?php

namespace Lib;

class PathInfo
{
    private $uri;
    private $selectors=array();
    private $parts=array();
    private $numSegments=0;
    private $nodeName='';
    private $file='';
    private $ext='';
    private $selectorString='';
    private $path='';
    private $minify=false;
    
    public function __construct($q)
    {
        $this->uri=$q;
        $q=trim($this->uri?$this->uri:Request::uri(),'/');
        // $q=trim($this->uri);
        
        $this->selectors=array();
        $parts=explode('/', $q);
        $this->parts=$parts;
        $this->numSegments=sizeof($this->parts);
        $this->nodeName=end($this->parts);
        $parts=explode('.',$this->nodeName);
        $this->ext=pathinfo($q, PATHINFO_EXTENSION);
        unset($parts[sizeof($parts)-1]);
        unset($parts[0]);
        if (sizeof($parts)) {
            foreach($parts as $part) {
                $this->selectors[]=$part;
            }
        }
        $this->selectorString=implode('.', $this->selectors);
        $pattern=(sizeof($this->selectors)?'.':'').$this->selectorString.'.'.$this->ext;
        $this->nodeName=str_replace($pattern, '', $this->nodeName);

       $this->path=str_replace($pattern, '', $q);
       //$this->path=$selectors[0];
        $this->minify=in_array('min', $this->selectors);
        $this->file=$this->path.$this->ext;
        $this->file=$this->path.($this->ext?'.':'').$this->ext;
    }

    public function getUri() {return $this->uri;}
    public function getSelectors() {return $this->selectors;}
    public function getParts() {return $this->parts;}
    public function getNumSegments() {return $this->numSegments;}
    public function getNodeName() {return $this->nodeName;}
    public function getExtension() {return $this->ext;}
    public function getSelectorString() {return $this->selectorString;}
    
    public function getPath() {return $this->path;}
    public function isMinify() {return $this->minify;}
    public function getFile() {return $this->file;}
    
    public function setMinify($flag) {$this->minify=$flag;}
}
