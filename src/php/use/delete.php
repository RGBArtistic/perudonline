<?php
  include_once '../apiHeaders/headerDel.php';
  require_once 'dbconnect.php';
  require_once 'functions.php';

  class DELETE extends DB
  {
    private $sql;
    private $query;
    private $condition = "";
    private $table;
    private $json;

    function __construct()
    {
      // Reception et transformation du json obtenu en ARRAY
      $this->json = json_decode(file_get_contents('php://input'), true);
    }

    public function prepareSql() {
      foreach ($this->json as $key => $value) {
        if($key == "table") {
          $this->table = $value ;
        }
        else $this->condition = "$key = :$key" ;
      }
      $this->sql = "DELETE FROM {$this->table} WHERE {$this->condition}" ;
      return $this->sql ;
    }

    public function deleteData() {
      DB::__construct();
      $this->prepareSql();
      $this->query = $this->dbconnect->prepare($this->sql);
      // Bind des infos en automatique
      foreach ($this->json as $key => $value) {
        if($key !== "table") {
          bindParamDb($this->query, ":$key", $value);
        }
      }
      // Execution de la requete SQL
      $this->query->execute();
    }

    public function dumpInfos() {
      var_dump($this->json) ;
    }
  }

  $test = new DELETE() ;
  $test->dumpInfos();
  $test->deleteData() ;
?>