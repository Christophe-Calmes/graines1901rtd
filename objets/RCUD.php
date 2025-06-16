<?php
class RCUD {
  protected $serverName = "localhost:3306";
  protected $userName = "r5v3";
  protected $password = "camille";
  protected $dbName = ["xgyd0647_rtdtech", "xgyd0647_blogRTD", "xgyd0647_rtdAssociation" ];
  private $sql;
  private $param;
  public function __construct($sql, $param) {
    $this->sql = $sql;
    $this->param = $param;
  }
  public function CUD($type) {
    try {
      $conn = new PDO("mysql:host=$this->serverName;dbname=".$this->dbName[$type], $this->userName, $this->password);
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch(PDOException $e) {
     echo "Error: " . $e->getMessage();
    }
    $data = $conn->prepare($this->sql);
    foreach ($this->param as $key) {
      $data->bindParam($key['prep'],$key['variable']);
    }
    $data->execute();
  }
  public function READ($type) {
    try {
      $conn = new PDO("mysql:host=$this->serverName;dbname=".$this->dbName[$type], $this->userName, $this->password);
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch(PDOException $e) {
     echo "Error: " . $e->getMessage();
    }
    $data = $conn->prepare($this->sql);
    foreach ($this->param as $key) {
      $data->bindParam($key['prep'],$key['variable']);
    }
    $data->execute();
    $data->setFetchMode(PDO::FETCH_ASSOC);
    $dataTraiter = $data->fetchAll();
    return $dataTraiter;
  }
  function __destruct() {

  }
}
