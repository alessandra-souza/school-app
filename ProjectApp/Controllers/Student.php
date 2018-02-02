<?php

namespace ProjectApp\Controllers;

class Student extends \ProjectApp\ContextProcessorServiceAbstract
{
    private $uriParts = array();
    
    public function setUriParts(array $uriParts)
    {
        $this->uriParts = $uriParts;
    }
    
    public function execute()
    {
        if (sizeof($this->uriParts) && $this->uriParts[0])
        {
            if (method_exists($this, $this->uriParts[0]))
            {
                $this->{$this->uriParts[0]}();
            }
            else
            {
                $this->output = array('error' => 'Method '. $this->uriParts[0] . ' does not exist!');
            }
        }
        else
        {
            $this->output = array('error' => 'Illegal request.');
        }
    }
    
     private function add()
    {
    $first_name = isset($_POST['first_name']) ? $_POST['first_name'] : null;
    $last_name = isset($_POST['last_name']) ? $_POST['last_name'] : null;
    $dob = isset($_POST['dob']) ? $_POST['dob'] : null;

   if ($first_name && $last_name )
      {
        $dbSettings = new \Lib\Database\DbSettings('mysql', 'localhost', 'test', 'test');
        $dbo = new \Lib\Database\Dbo($dbSettings);
          
        $statement = 'INSERT INTO ipd11phpproject.students( first_name, last_name, dob ) VALUES('
                .$dbo->quote(\Lib\RequestHandler\DataSanitizer::sanitize('first_name', 'post'))
                .','.$dbo->quote(\Lib\RequestHandler\DataSanitizer::sanitize('last_name', 'post'))
                .','.$dbo->quote(\Lib\RequestHandler\DataSanitizer::sanitize('dob', 'post'))
                .')';

        $dbo->query($statement);
              
        $this->output = array(
        'success' => true,
        'message' => ($_POST['first_name']) .", you are enrolled successfully!" 
            );
    }
       else
     {
          $this->output = array(
            'error' => "Failed to submit");
      }
  }
        
     private function list()
    {
        $dbSettings = new \Lib\Database\DbSettings('mysql', 'localhost', 'test', 'test');
        $dbo = new \Lib\Database\Dbo($dbSettings);
        $statement = "SELECT id, first_name, last_name, dob FROM ipd11phpproject.students";
        $row=$dbo->loadAssocList($statement);   

        $this->output = array(
            'data' => $row,
            'success' => true,
            'message' => 'Successfully processed.' . json_encode($_POST)
        );
    }
    
    private function bycourse()
    {
      $code = isset($_POST['code']) ? $_POST['code'] : null;
        // process the data (i.e. save to database or/and send email)
        $dbSettings = new \Lib\Database\DbSettings('mysql', 'localhost', 'test', 'test');
        $dbo = new \Lib\Database\Dbo($dbSettings);

        $statement ="SELECT id, first_name,last_name,dob FROM ipd11phpproject.students where id in (SELECT student_id FROM ipd11phpproject.student_courses as sc  Left JOIN  ipd11phpproject.courses as c ON  (sc.course_id=c.id )where c.code =".$code.")";
           
         $row=$dbo->loadAssocList($statement);            
         $this->output = array(
          'data' => $row,
           'success' => true,
           'message' => 'Successfully processed.'
        );
    }
  }
    
