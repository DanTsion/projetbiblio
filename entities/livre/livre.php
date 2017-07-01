<?php
class Livre
{
    private $_idLivre;
    private $_titre;
    private $_auteur;
    private $_editeur;
    private $_dateDeParution;
    private $_isbn;
    private $_dispo;
    
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
    
    public function idLivre()
    {
        return $this->_idLivre;
    }
    
    public function titre()
    {
        return $this->_titre;
    }
    
    public function auteur()
    {
        return $this->_auteur;
    }
    
    public function editeur()
    {
        return $this->_editeur;
    }
    
    public function dateDeParution()
    {
        return $this->_dateDeParution;
    }
    
    public function isbn()
    {
        return $this->_isbn;
    }
    
    public function dispo()
    {
        return $this->_dispo;
    }
    
    // SETTERS //
    
    public function setIdLivre($idLivre)
    {
        $idLivre = (int) $idLivre;
        
        if($idLivre > 0)
        {
            $this->_idLivre = $idLivre;
        }
        else
        {
            echo '<script>alert("Erreur avec ce client");</script>';
        }
    }
    
    public function setAuteur($auteur)
    {
        $regex = "/^[A-Z]{1,}[A-Za-zàáâäçèéêëìíîïñòóôöùúûü ,.'-]+$/";
        if(preg_match($regex, $auteur))
        {
            $this->_auteur = $auteur;
        }
        else
        {
            echo '<script>alert("Erreur avec ce livre");</script>';
        }
    }
    
    public function setEditeur($editeur)
    {
        $regex = "/^[A-Z]{1,}[A-Za-zàáâäçèéêëìíîïñòóôöùúûü ,.'-]+$/";
        if(preg_match($regex, $editeur))
        {
            $this->_editeur = $editeur;
        }
        else
        {
            echo '<script>alert("Erreur avec ce livre");</script>';
        }
    }
    
    public function setTitre($titre)
    {
        if(!empty($titre))
        {
            $this->_titre = $titre;
        }
        else
        {
            echo '<script>alert("Erreur avec ce livre");</script>';
        }
    }
    
    public function setDateDeParution($dateDeParution)
    {
        $regex = "/(1[0-9][0-9][0-9]|20[0-9][0-9])(\-)(0[1-9]|1[0-2])(\-)(0[1-9]|[1-2][0-9]|30|31)/";
        if(!empty($dateDeParution) && preg_match($regex, $dateDeParution))
        {
            $this->_dateDeParution = $dateDeParution;
        }
        else
        {
            echo '<script>alert("Erreur avec ce livre");</script>';
        }
    }
    
    public function setIsbn($isbn)
    {
        $regex = "/^(ISBN){1}[ ]{1}[0-9]{3}[ ]{1}[0-9]{1}[ ]{1}[0-9]{4}[ ]{1}[0-9]{4}[ ]{1}[0-9]{1}$/";
        if(preg_match($regex, $isbn))
        {
            $this->_isbn = $isbn;
        }
        else
        {
            echo '<script>alert("Erreur avec ce livre");</script>';
        }
    }
    
    public function setDispo($dispo)
    {
        $this->_dispo = $dispo;
    }
    
}