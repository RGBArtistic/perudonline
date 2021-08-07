<?php
// Prérequis au fonctionnement de l'API en POST
  // include '../apiHeaders/headerPost.php';
  require_once 'dbconnect.php';
  require_once 'functions.php';

  // Création de l'objet POST
  class POST extends DB {
    private $sql ;
    private $query ;
    private $col = "";
    private $table ;
    private $post;

    function __construct($table)
    {
      $this->post = $_POST;
      $this->table = $table;
    }

    // Fonction d'automatisation de la requete SQL INSERT en fonction du $_POST
    private function prepareSql() {
      $i = 0;
      $sqlVal = "";
      foreach($this->post as $key => $value)
      {
        $i += 1 ; 
        if($i === count($this->post))
        {
          // selection de la derniere colonne
          $this->col = $this->col . "$key";
          // dernière valeur à rentrer
          $sqlVal = $sqlVal . ":$key";
        }
        else {
          // selection des colonnes
          $this->col = $this->col . "{$key}, ";
          // valeurs à rentrer
          $sqlVal = $sqlVal . ":{$key}, ";
        }     
      }
      // Création de la requete SQL avec les valeurs et return de cette valeur
      $this->sql = "INSERT INTO {$this->table}({$this->col}) VALUES ({$sqlVal})";
      return $this->sql ;
    }

    // Fonction d'execution de la requete SQL
    public function postData() {
      // Appel du constructeur de la classe parente DB 
      DB::__construct() ;
      $this->prepareSql();
      $this->query = $this->dbconnect->prepare($this->sql) ;
      // Bind des infos en automatique
      foreach($this->post as $key => $value)
      {
        bindParamDb($this->query, ":$key", $value) ;
      }
      // Execution de la requete SQL
      $this->query->execute() ;
    }  
  }

  if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $test = new POST('test') ;
    $test->postData() ;
  }
?>
