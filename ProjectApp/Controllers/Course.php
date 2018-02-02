<?php

namespace ProjectApp\Controllers;

class Course extends \ProjectApp\ContextProcessorServiceAbstract
{
    private $uriParts = array();
    
    public function setUriParts(array $uriParts)
    {
        $this->uriParts = $uriParts;
    }
    
    public function execute()
    {
        // check if 
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
      $code = isset($_POST['code']) ? $_POST['code'] : null;
      $name = isset($_POST['name']) ? $_POST['name'] : null;
      $description = isset($_POST['description']) ? $_POST['description'] : null;

     if ($code && $name )
        {
          $dbSettings = new \Lib\Database\DbSettings('mysql', 'localhost', 'test', 'test');
          $dbo = new \Lib\Database\Dbo($dbSettings);
          $statement = 'INSERT INTO ipd11phpproject.courses( code, name, description ) VALUES('
                .$dbo->quote(\Lib\RequestHandler\DataSanitizer::sanitize('code', 'post'))
                .','.$dbo->quote(\Lib\RequestHandler\DataSanitizer::sanitize('name', 'post'))
                .','.$dbo->quote(\Lib\RequestHandler\DataSanitizer::sanitize('description', 'post'))
                .')';
          $dbo->query($statement);
       
          $this->output = array(
          'success' => true,
          'message' => ($_POST['name']) ." Course was added successfully!" 
            );
      }
      else
      {
      $this->output = array('error' => "Failed to submit" );
      }
  }
      private function addstudent ()
      {
        $student_id = isset($_POST['studentid']) ? $_POST['studentid'] : null;
        $course_id = isset($_POST['courseid']) ? $_POST['courseid'] : null;
   

   if ($student_id && $course_id )
      {
          $dbSettings = new \Lib\Database\DbSettings('mysql', 'localhost', 'test', 'test');
          $dbo = new \Lib\Database\Dbo($dbSettings);

          $statement = 'INSERT INTO ipd11phpproject.student_courses( student_id, course_id ) VALUES('
                .$dbo->quote(\Lib\RequestHandler\DataSanitizer::sanitize('studentid', 'post'))
                .','.$dbo->quote(\Lib\RequestHandler\DataSanitizer::sanitize('courseid', 'post'))
                .')';

          $result=$dbo->query($statement);

          $message1;
          $typeMessage = '';

          if($result)
          {
            $message1= " Registration is done Successfully";
            $typeMessage = 'success';
          }
          else
          {
            $message1= "Error of Registration \"registered before\"";
            $typeMessage = 'error';
          }
        
          $this->output = array(
          $typeMessage => true,
          'message' => $message1
            );
      }
      else
      {
      $this->output = array('error' => "Failed to submit" );
      }
  }
     private function list()
    {
        // process the data (i.e. save to database or/and send email)

        $dbSettings = new \Lib\Database\DbSettings('mysql', 'localhost', 'test', 'test');
        $dbo = new \Lib\Database\Dbo($dbSettings);


          $statement = "SELECT id, code,name,description,count(course_id) as totalNumberStudents from  ipd11phpproject.courses as c Left JOIN  ipd11phpproject.student_courses as sc ON  (sc.course_id=c.id ) GROUP by  c.id,c.code,c.name,c.description";

          $row=$dbo->loadAssocList($statement);
     
       
        $this->output = array(
            'data' => $row,
            'success' => true,
            'message' => 'Successfully processed.' . json_encode($_POST)

        );
    }
    
}