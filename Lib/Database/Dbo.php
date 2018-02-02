<?php

namespace Lib\Database;

final class Dbo
{
    private $dns;
    private $username;
    private $password;
    private $options;
    private $pdo;
    private $prepare;
    
    public function __construct(DbSettings $dbSettings)
    {
        $settings = $dbSettings->getSettings();
        $this->setDNS($settings);
        $this->username = isset($settings['username']) ? $settings['username'] : null;
        $this->password = isset($settings['password']) ? $settings['password'] : null;
        $this->options = isset($settings['options']) ? $settings['options'] : null;
        
        if ($this->dns && $this->username && $this->password)
        {
            $this->pdo = new \PDO($this->dns, $this->username, $this->password);
        }
    }
    
    public function getPdo() {return $this->pdo;}
    
    public function quote(string $string) {
        return $this->getPdo()->quote($string);
    }
    
    public function prepare(string $statement) {
        $this->prepare = $this->getPDO()->prepare($statement);
        return $this->prepare;
    }
    
    public function execute(array $inputParams) {
        $ret = $this->getPrepare()->execute($inputParams);
        $this->terminateOnError();
        return $ret;
    }
    
    public function query(string $statement) {
        $ret = $this->getPDO()->query($statement);
        $this->terminateOnError();
        return $ret;
    }
    
    public function bindParam($param, &$value, $dataType=\PDO::PARAM_STR, $length = null, $driver_options = null) {
        return $this->getPrepare()->bindParam($param, $value, $dataType, $length, $driver_options);
    }
    
    public function loadAssoc(string $statement=null) {
        if ($statement) {
            $stm = $this->getPDO()->prepare($statement);
            $stm->execute();
            $this->terminateOnError();
            return $stm->fetch(\PDO::FETCH_ASSOC);
        }
        $this->getPrepare()->execute();
        $this->terminateOnError();
        return $this->getPrepare()->fetch(\PDO::FETCH_ASSOC);
    }
    
    public function loadAssocList(string $statement = null) {
        if ($statement) {
            $stm = $this->getPDO()->prepare($statement);
            $stm->execute();
            $this->terminateOnError();
            return $stm->fetchAll(\PDO::FETCH_ASSOC);
        }
        $this->getPrepare()->execute();
        $this->terminateOnError();
        return $this->getPrepare()->fetchAll(\PDO::FETCH_ASSOC);
    }
    
    public function loadObject(string $statement=null) {
        if ($statement) {
            $stm = $this->getPDO()->prepare($statement);
            $stm->execute();
            $this->terminateOnError();
            return $stm->fetchObject('stdClass');
        }
        $this->getPrepare()->execute();
        $this->terminateOnError();
        return $this->getPrepare()->fetchObject('stdClass');
    }

    public function loadObjectList(string $statement=null) {
        if ($statement) {
            $stm = $this->getPDO()->prepare($statement);
            $stm->execute();
            $this->terminateOnError();
            return $stm->fetchAll(\PDO::FETCH_OBJ);
        }
        $this->getPrepare()->execute();
        $this->terminateOnError();
        return $this->getPrepare()->fetchAll(\PDO::FETCH_OBJ);
    }

    public function insertId() {return $this->getPDO()->lastInsertId();}
    
    public function hasError() {return $this->errorCode() > 0;}
    
    private function getPrepare() {
        if (!($this->prepare instanceof \PDOStatement)) {
            new \Exception("Db.prepare is empty (".get_called_class().".getPrepare()).");
        }
        return $this->prepare;
    }
    
    private function terminateOnError() {
        if ($this->hasError()) {
            new \Exception($this->getErrorMessage(), $this->errorCode());
        }
    }
    
    public function errorCode() {
        return $this->getPDO()->errorCode();
    }
    
    public function getErrorMessage() {
        $error = $this->getPDO()->errorInfo();
        return end($error);
    }
    
    private function setDNS(array $settings)
    {
        $dns = array();
        if (isset($settings['driver']))
        {
            $dns[] = $settings['driver'];
        }
        if (isset($settings['host']))
        {
            $dns[] = ':host='.$settings['host'];
        }
        if (isset($settings['port']))
        {
            $dns[] = ';port='.$settings['port'];
        }
        if (isset($settings['dbname']))
        {
            $dns[] = ';dbname='.$settings['dbname'];
        }
        if (sizeof($dns))
        {
            $this->dns = implode('', $dns);
        }
    }
}