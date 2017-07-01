<?php
require_once '../db/database.php';
require 'livre.php';
class LivreManager
{
  private $_db; // Instance de PDO
  
  public function __construct($db)
  {
    $this->setDb($db);
  }
  
  public function addLivre(Livre $livre)
  {
    $q = $this->_db->prepare('INSERT INTO livre(`titre`, `auteur`, `editeur`, `dateDeParution`, `isbn`)
      VALUES(:titre, :auteur, :editeur, :dateDeParution, :isbn)');
    $q->bindValue(':titre', $livre->titre(), PDO::PARAM_STR);
    $q->bindValue(':auteur', $livre->auteur(), PDO::PARAM_STR);
    $q->bindValue(':editeur', $livre->editeur(), PDO::PARAM_STR);
    $q->bindValue(':dateDeParution', $livre->dateDeParution());
    $q->bindValue(':isbn', $livre->isbn(), PDO::PARAM_STR);
    $q->execute();
    
    // A voir
    $livre->hydrate([
      'idLivre' => $this->_db->lastInsertId(),
    ]);
  }
  
  public function count()
  {
    return $this->_db->query('SELECT COUNT(*) FROM livre')->fetchColumn();
  }
  
  public function countEmprunts()
  {
    return $this->_db->query('SELECT COUNT(*) FROM livre WHERE dispo = 0')->fetchColumn();
  }
  
  public function delete(Livre $livre)
  {
    $this->_db->exec('DELETE FROM livre WHERE idLivre = '.$livre->idLivre());
  }
  
  public function get($info)
  {
    if (is_int($info))
    {
      $q = $this->_db->query('SELECT idLivre, titre, auteur, editeur, dateDeParution,
        isbn, dispo FROM livre WHERE idLivre = '.$info);
      $donnees = $q->fetch(PDO::FETCH_ASSOC);
      
      return $donnees;
    }
  }
  
  // Récupère la liste des livres disponibles
  public function getListDispo()
  {
    $livres = [];
    
    $q = $this->_db->prepare('SELECT idLivre, titre, auteur, editeur, dateDeParution,
      isbn, dispo FROM livre WHERE dispo=1 ORDER BY titre ASC');
      $q->execute();
      
      while($donnees = $q->fetch(PDO::FETCH_ASSOC))
      {
        $livres[] = new Livre($donnees);
      }
      return $livres;
  }
  
  // Récupère la liste de tous les livres
  public function getList()
  {
    $livres = [];
    
    $q = $this->_db->prepare('SELECT idLivre, titre, auteur, editeur, dateDeParution,
      isbn, dispo FROM livre ORDER BY titre ASC');
    $q->execute();
    
    while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
    {
      $livres[] = new Livre($donnees);
    }
    
    return $livres;
  }
  
  public function updateLivre(Livre $livre)
  {
    $q = $this->_db->prepare('UPDATE livre SET titre  = :titre, auteur = :auteur, editeur = :editeur,
      dateDeParution = :dateDeParution, isbn = :isbn WHERE idLivre = :idLivre');
    
    $q->bindValue(':titre', $livre->titre(), PDO::PARAM_STR);
    $q->bindValue(':auteur', $livre->auteur(), PDO::PARAM_STR);
    $q->bindValue(':editeur', $livre->editeur(), PDO::PARAM_STR);
    $q->bindValue(':dateDeParution', $livre->dateDeParution());
    $q->bindValue(':isbn', $livre->isbn(), PDO::PARAM_STR);
    $q->bindValue(':idLivre', $livre->idLivre(), PDO::PARAM_INT);
    
    $q->execute();
  }
  
  public function emprunterLivre($idLivre)
  {
    $q = $this->_db->prepare('UPDATE livre SET dispo = 0 WHERE idLivre = :idLivre');
    $q->bindValue(':idLivre', $idLivre, PDO::PARAM_INT);
    $q->execute();
  }
  
  public function setDb(PDO $db)
  {
    $this->_db = $db;
  }
}