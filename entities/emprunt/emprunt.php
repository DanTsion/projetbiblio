<?php
class Emprunt
{
    private $_idEmprunt;
    private $_client;
    private $_livre;
    private $_dateEmprunt;
    
    public function __construct(array $donnees)
    {
        $this->hydrate($donnees);
    }
    
    public function hydrate(array $donnees)
    {
        foreach ($donnees as $key => $value)
        {
            $method = 'set'.ucfirst($key);
            
            if (method_exists($this, $method))
            {
                $this->$method($value);
            }
        }
    }
    // GETTERS //
    
    public function idEmprunt()
    {
        return $this->_idEmprunt();
    }
    
    public function client()
    {
        return $this->_client;
    }
    
    public function livre()
    {
        return $this->_livre;
    }
    
    public function dateEmprunt()
    {
        return $this->_dateEmprunt;
    }
    
    // SETTERS //
    
    public function setIdEmprunt($idEmprunt)
    {
        $idEmprunt = (int) $idEmprunt;
        
        if($idEmprunt > 0)
        {
            $this->_idEmprunt = $idEmprunt;
        }
        else
        {
            echo '<script>alert("Erreur avec cet emprunt");</script>';
        }
    }
    
    public function setClient($client)
    {
        $this->_client = $client;
    }
    
    public function setLivre($livre)
    {
        $this->_livre = $livre;
    }
    
    
}