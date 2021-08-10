<?php
  include_once '../apiHeaders/headerPut.php';
  require_once 'dbconnect.php';
  require_once 'functions.php';

  class UPDATE extends DB 
  {
    private $sql;
    private $query;
    private $col = "";
    private $table;
    private $json;
  
    function __construct()
    {
      // Reception et transformation du json obtenu en ARRAY
      $this->json = json_decode(file_get_contents('php://input'), true);
    }
  
    // Fonction d'automatisation de la requete SQL UPDATE en fonction du json obtenu
    private function prepareSql()
    {
      $i = 0;
      $sqlVal = "";
      foreach ($this->json as $key => $value) {
        $i += 1;
        $this->col = $key ;
        // déterminer dans quelle table effectuer la requete
        if($key == 'table') {
          $this->table = $value ;
        }
        // selection de la derniere entrée
        else if ($i === count($this->json)) {
          $sqlVal = $sqlVal . "{$this->col} = :$key";
        } else {
          // Modification des valeurs selon leur nom dans la colonne
          $sqlVal = $sqlVal . "{$this->col} = :$key, ";
        }
      }
      // Création de la requete SQL avec les valeurs et return de cette valeur
      $this->sql = "UPDATE {$this->table} SET {$sqlVal}";
      return $this->sql;
    }
    
    // Fonction d'execution de la requete SQL
    public function updateData()
    {
      // Appel du constructeur de la classe parente DB 
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
  }

$test = new UPDATE();
$test->updateData()
?>