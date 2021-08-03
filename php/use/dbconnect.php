<?php
class DB 
{
  public $dbconnect ;
  private $servername = "localhost";
  private $dbname = "perudonline";
  private $user = "letesteur";
  private $password = "test";

  // connection à la DB avec les identifiants ci-dessus
  public function __construct()
  {
    try {
      $this->dbconnect = new PDO("mysql:host={$this->servername};dbname={$this->dbname}", $this->user, $this->password);
      $this->dbconnect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION) ;
    } catch(PDOException $e) { echo "Connexion échouée". $e->getMessage(); }
  }
}