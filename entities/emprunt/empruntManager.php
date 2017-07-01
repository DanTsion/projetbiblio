<?php
require_once '../db/database.php';
require 'emprunt.php';
class EmpruntManager
{
    private $_db;
    
    public function __construct($db)
    {
        $this->setDb($db);
    }
    
    public function addEmprunt(Emprunt $emprunt)
    {
        $q = $this->_db->prepare('INSERT INTO emprunt(idClient, idLivre)VALUES(:idClient, :idLivre)');
        $q->bindValue(':idClient', $emprunt->client()->idClient(), PDO::PARAM_INT);
        $q->bindValue('idLivre', $emprunt->livre()->idLivre(), PDO::PARAM_INT);
        $q->execute();
        
        $emprunt->hydrate([
        'idEmprunt' =>$this->_db->lastInsertId(),
        ]);
    }
    
    public function count()
    {
        return $this->_db->query('SELECT COUNT(*) FROM emprunt')->fetchColumn();
    }
    
    public function delete($idLivre)
    {
        $this->_db->exec('DELETE FROM emprunt WHERE idLivre =' .$idLivre);
    }
    
    public function get($info)
    {
        if(is_int($info))
        {
            $q = $this->_db->query('SELECT idEmprunt, idClient, idLivre FROM emprunt WHERE idEmprunt ='.$info);
            $donnees = $q->fetch(PDO::FETCH_ASSOC);
            
            return $donnees;
        }
    }
    
    public function getList()
    {
        $emprunts = [];
        $q = $this->_db->prepare('SELECT idEmprunt, idClient, idLivre FROM emprunt ORDER BY idClient ASC');
        $q->execute();
        
        while($donnees = $q->fetch(PDO::FECTH_ASSOC))
        {
            $emprunts[] = new Emprunt($donnees);
        }
        return $emprunts;
    }
    
    public function updateEmprunt(Emprunt $emprunt)
    {
        $q = $this->_db->prepare('UPDATE emprunt SET idClient = :idClient, idLivre = :idLivre, WHERE idEmprunt = :idEmprunt');
        $q->bindValue(':idClient', $emprunt->client()->idClient(), PDO::PARAM_INT);
        $q->bindValue(':idLivre', $emprunt->livre()->idLivre(), PDO::PARAM_INT);
        $q->bindValue(':idEmprunt', $emprunt->idEmprunt(), PDO::PARAM_INT);
        $q->execute();
    }
    
    public function dernierEmprunt()
    {
        return $this->_db->query('SELECT titre FROM emprunt NATURAL JOIN livre ORDER BY dateEmprunt DESC LIMIT 1')->fetchColumn();
    }
    
    public function setDb(PDO $db)
    {
        $this->_db = $db;
    }
}