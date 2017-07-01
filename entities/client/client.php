<?php
class Client
{
    private $_idClient;
    private $_nom;
    private $_prenom;
    private $_dateDeNaissance;
    private $_email;
    private $_adresse;
    private $_codePostal;
    private $_ville;
    
    
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
    
    public function idClient()
    {
        return $this->_idClient;
    }
    
    public function nom()
    {
        return $this->_nom;
    }
    
    public function prenom()
    {
        return $this->_prenom;
    }
    
    public function dateDeNaissance()
    {
        return $this->_dateDeNaissance;
    }
    
    public function email()
    {
        return $this->_email;
    }
    
    public function adresse()
    {
        return $this->_adresse;
    }
    
    public function codePostal()
    {
        return $this->_codePostal;
    }
    
    public function ville()
    {
        return $this->_ville;
    }

    // SETTERS //
    
    public function setIdClient($idClient)
    {
        $idClient = (int) $idClient;
    
        if ($idClient > 0)
        {
            $this->_idClient = $idClient;
        }
        else
        {
            echo '<script>alert("Erreur avec ce client");</script>';
        }
    }
    
    public function setNom($nom)
    {
        $regex = "/^[A-Z' ]+$/";
        if (is_string($nom) && preg_match($regex, $nom))
        {
            $this->_nom = $nom;
        }
        else
        {
            echo '<script>alert("Erreur avec ce client");</script>';
        }
    }
    
    public function setPrenom($prenom)
    {
        $regex = "/^[A-Z]{1}[a-zàáâäçèéêëìíîïñòóôöùúûü']+([-]{1}[A-Z]{1}[a-zàáâäçèéêëìíîïñòóôöùúûü']+)?$/";
        if(preg_match($regex, $prenom))
        {
            $this->_prenom = $prenom;
        }
        else
        {
            echo '<script>alert("Erreur avec ce client");</script>';
        }
    }
    
    public function setDateDeNaissance($dateDeNaissance)
    {
        $regex = "/(1[0-9][0-9][0-9]|20[0-9][0-9])(\-)(0[1-9]|1[0-2])(\-)(0[1-9]|[1-2][0-9]|30|31)/";
        if(!empty($dateDeNaissance) && preg_match($regex, $dateDeNaissance))
        {
            $this->_dateDeNaissance = $dateDeNaissance;
        }
        else
        {
            echo '<script>alert("Erreur avec ce client");</script>';
        }
    }
    
    public function setEmail($email)
    {
        if(filter_var($email,FILTER_VALIDATE_EMAIL))
        {
            $this->_email = $email;
        }
        else
        {
            echo '<script>alert("Erreur avec ce client");</script>';
        }
    }
    
    public function setAdresse($adresse)
    {
        if(!empty($adresse))
        {
            $this->_adresse = $adresse;
        }
        else
        {
            echo '<script>alert("Erreur avec ce client");</script>';
        }
    }
    
    public function setCodePostal($codePostal)
    {
        $codePostal = (int)$codePostal;
        $regex = "/^[0-9]{5}$/";
        if(preg_match($regex, $codePostal))
        {
            $this->_codePostal = $codePostal;
        }
        else
        {
            echo '<script>alert("Erreur avec ce client");</script>';
        }
    }
    
    public function setVille($ville)
    {
        $regex = "/^[A-Z- ']{3,}$/";
        if(preg_match($regex, $ville))
        {
            $this->_ville = $ville;
        }
        else
        {
            echo '<script>alert("Erreur avec ce client");</script>';
        }
    }
    
    
}
