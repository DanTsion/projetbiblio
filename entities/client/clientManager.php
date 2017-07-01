<?php 
require_once '../db/database.php';
require 'client.php';
class ClientManager
{
  private $_db; // Instance de PDO
  
  public function __construct($db)
  {
    $this->setDb($db);
  }
  
  public function addClient(Client $client)
  { 
    $q = $this->_db->prepare('INSERT INTO client(`nom`, `prenom`, `dateDeNaissance`, `email`, `adresse`, `codePostal`, `ville`) 
    VALUES(:nom, :prenom, :dateDeNaissance, :email, :adresse, :codePostal, :ville)');
    $q->bindValue(':nom', $client->nom(), PDO::PARAM_STR);
    $q->bindValue(':prenom', $client->prenom(), PDO::PARAM_STR);
    $q->bindValue(':dateDeNaissance', $client->dateDeNaissance());
    $q->bindValue(':email', $client->email(), PDO::PARAM_STR);
    $q->bindValue(':adresse', $client->adresse(), PDO::PARAM_STR);
    $q->bindValue(':codePostal', $client->codePostal(), PDO::PARAM_INT);
    $q->bindValue(':ville', $client->ville(), PDO::PARAM_STR);
    $q->execute();
    
      $client->hydrate([
      'idClient' => $this->_db->lastInsertId(),
    ]);
  }
  
  public function count()
  {
    return $this->_db->query('SELECT COUNT(*) FROM client')->fetchColumn();
  }
  
  public function delete(Client $client)
  {
    $this->_db->exec('DELETE FROM client WHERE idClient = ' .$client->idClient());
  }
  
    public function get($info)
  {
    if (is_int($info))
    {
      $q = $this->_db->query('SELECT idClient, nom, prenom, dateDeNaissance, email, adresse, 
                              codePostal, ville FROM client WHERE idClient = '.$info);
      $donnees = $q->fetch(PDO::FETCH_ASSOC);
      
      return $donnees;
    }
  }
  
  // Récupère la liste de tous les clients
  public function getList()
  {
    $clients = [];
    
    $q = $this->_db->prepare('SELECT idClient, nom, prenom, dateDeNaissance, email, adresse, 
                              codePostal, ville FROM client ORDER BY nom ASC');
    $q->execute();
    
    while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
    {
      $clients[] = new Client($donnees);
    }
    
    return $clients;
    
  }
  
  public function updateClient(Client $client)
  {
    $q = $this->_db->prepare('UPDATE client SET nom = :nom, prenom = :prenom, dateDeNaissance = :dateDeNaissance, 
       email = :email, adresse = :adresse, codePostal = :codepostal, ville = :ville WHERE idClient = :idClient');
    
    $q->bindValue(':nom', $client->nom(), PDO::PARAM_STR);
    $q->bindValue(':prenom', $client->prenom(), PDO::PARAM_STR);
    $q->bindValue(':dateDeNaissance', $client->dateDeNaissance());
    $q->bindValue(':email', $client->email(), PDO::PARAM_STR);
    $q->bindValue(':adresse', $client->adresse(), PDO::PARAM_STR);
    $q->bindValue(':codepostal', $client->codePostal(), PDO::PARAM_INT);
    $q->bindValue(':ville', $client->ville(), PDO::PARAM_STR);
    $q->bindValue(':idClient', $client->idClient(), PDO::PARAM_INT);
    $q->execute();
  }
  
  // Récupère le nombre d'emprunts d'un client
  public function nbEmprunts(Client $client)
  {
    $q = $this->_db->prepare('SELECT nbreEmprunt(?)');
    $q->execute(array($client->idClient()));
    $nbEmprunts = $q->fetchAll();
    
    return $nbEmprunts[0][0];
  }
  
  public function setDb(PDO $db)
  {
    $this->_db = $db;
  }
}