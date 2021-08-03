<?php
// Prérequis au fonctionnement de l'API en GET
include_once 'dbconnect.php';
include_once '../apiHeaders/headerAPI_GET.php';

// Création de l'objet GET
class GET extends DB {
  private $sql ;
  private $query ;
  public $data ;
  private $col ;
  private $table ;
  private $precision ;

  // Mise en place des paramètres SQL (Colonnes affectées, table, paramètres supplémentaires)
  function __construct($col, $table, $precision = null) {
    $this->col = $col ;
    $this->table = $table ;
    $this->precision = $precision ;
  }

  // Création de la fonction afin d'aller cherche sur la base de donnée les infos dont on a besoin
  public function getData() {
    DB::__construct() ;
    $this->sql = "SELECT {$this->col} FROM {$this->table} {$this->precision}" ;
    $this->query = $this->dbconnect->prepare($this->sql) ;
    $this->query->execute() ;
    $this->data = $this->query->fetchAll(PDO::FETCH_CLASS) ;
    // Création du tableau à partir des données obtenues
    if ($this->query->rowCount() > 0) {
      $json = [];
      $json[$this->table] = [] ;
      foreach($this->data as $valueIndexCol) {
        $dataCell = [] ;
        foreach($valueIndexCol as $key => $value) {
          $dataCell[$key] = $value ;
        }
        // Création du JSON à partir du tableau précédemment créé
        $json[$this->table][] = $dataCell ;
      }
      // Renvoie du statut de la requête et affichage des données en json
      http_response_code(200) ;
      echo json_encode($json) ;
      } else echo json_encode(['error' => 'Aucun client dans la base de données']) ; // Si aucune donnée n'est disponible
  }
}

$test = new GET('username, tag', 'user') ;
$test->getData() ;
