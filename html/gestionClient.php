<?php
require_once '../entities/client/clientManager.php';
include '../header.php';
$pdo = Database::connect();
$manager = new ClientManager($pdo);
if(isset($_POST['creerClient']) && isset($_POST['nom']) && !empty(trim($_POST['nom'])) 
    && isset($_POST['prenom']) && !empty(trim($_POST['prenom'])) 
    && isset($_POST['dateDeNaissance']) && !empty(trim($_POST['dateDeNaissance'])) 
    && isset($_POST['email']) && !empty(trim($_POST['email'])) 
    && isset($_POST['adresse']) && !empty(trim($_POST['adresse'])) 
    && isset($_POST['codePostal']) && !empty(trim($_POST['codePostal'])) 
    && isset($_POST['ville']) && !empty(trim($_POST['ville'])))
{
    $client = new Client([
        'nom' => trim($_POST['nom']),
        'prenom' => trim($_POST['prenom']), 
        'dateDeNaissance' => trim($_POST['dateDeNaissance']),
        'email' => trim($_POST['email']),
        'adresse' => trim($_POST['adresse']),
        'codePostal' => trim($_POST['codePostal']),
        'ville' => trim($_POST['ville'])
        ]);
        
    $manager->addClient($client);
}
elseif(isset($_POST['modifClient']) && isset($_POST['idClient']) && !empty(trim($_POST['idClient']))
    && isset($_POST['nom']) && !empty(trim($_POST['nom']))
    && isset($_POST['prenom']) && !empty(trim($_POST['prenom']))
    && isset($_POST['dateDeNaissance']) && !empty(trim($_POST['dateDeNaissance'])) 
    && isset($_POST['email']) && !empty(trim($_POST['email'])) 
    && isset($_POST['adresse']) && !empty(trim($_POST['adresse'])) 
    && isset($_POST['codePostal']) && !empty(trim($_POST['codePostal'])) 
    && isset($_POST['ville']) && !empty(trim($_POST['ville'])))
{
    $client = new Client([
        'idClient' => trim($_POST['idClient']),
        'nom' => trim($_POST['nom']),
        'prenom' => trim($_POST['prenom']), 
        'dateDeNaissance' => trim($_POST['dateDeNaissance']),
        'email' => trim($_POST['email']),
        'adresse' => trim($_POST['adresse']),
        'codePostal' => trim($_POST['codePostal']),
        'ville' => trim($_POST['ville'])
        ]);
        
    $manager->updateClient($client);
}

?>
<title>Gestion client</title>
<script type="text/javascript" src="../js/regexclient.js"></script>
<script src="../js/gestionClient.js"></script>
<link rel="stylesheet" href="../css/dialog.css" />
</head>
    <body>
        
        <div class="container">

        <div class="row">
            <a href="../html/creationClient.php" class="btn btn-success">Ajouter un client</a>
        </div><br/>
        <div class="row">
        <div class="table-responsive">
            <table id="listeClients" class="table table-hover table-bordered">
                <thead>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Date de naissance</th>
                    <th>Adresse Email</th>
                    <th>Adresse Postale</th>
                    <th>Code Postal</th>
                    <th>Ville</th>
                    <th>Emprunts en cours</th>
                    <th colspan="2">Gestion</th>
                </thead>
            
            <tbody>
<?php


//on récupère la liste des clients classés par nom
$clients = $manager->getList();

if (empty($clients))
{
    echo '<script>alert("Aucun client répertorié");</script>';
}

else
{
  foreach ($clients as $unClient)
  {
    
    echo '<tr>';
    echo '<td>' . $unClient->nom() . '</td>';
    echo '<td>' . $unClient->prenom() . '</td>';
    echo '<td>' . date_format(date_create($unClient->dateDeNaissance()),"d/m/Y") . '</td>';
    echo '<td>' . $unClient->email() . '</td>';
    echo '<td>' . $unClient->adresse() . '</td>';
    echo '<td>' . $unClient->codePostal() . '</td>';
    echo '<td>' . $unClient->ville() . '</td>';
    echo '<td>' . $manager->nbEmprunts($unClient) .'</td>';
    echo '<td><button class="btn btn-primary" value="' . $unClient->idClient() . '">Modifier</button></td>';// un td pour le bouton d'update
    echo '<td><button class="btn btn-danger"  value="' . $unClient->idClient() . '">Supprimer</button></td>';// un autre td pour le bouton de suppression
    echo '</tr>';
    
  }
}

Database::disconnect(); //on se deconnecte de la base
?>    
                </tbody>
            </table>
            </div>
        </div>
        </div>
        <div id="updatediv">
        <form class="form col-lg-offset-3 col-lg-5" action="" id="update" method="POST" onsubmit="return verifForm(this)">
        <img src="../images/button_cancel.png" class="img" id="cancel"/>
            <legend>Modification d'un Client</legend>
                    <input name="idClient" id="idClient" type="hidden">
                
                    <label for="nom">Nom : </label>
                    <input name="nom" id="nom" type="text" placeholder="Veuillez entrer un nom" class="form-control" onblur="verifNomClient(this)">
                
                    <label for="prenom">Prénom : </label>
                    <input name="prenom" id="prenom" type="text" placeholder="Veuillez entrer un prenom" class="form-control" onblur="verifPrenomClient(this)">
                
                    <label for="dateDeNaissance">Date de Naissance : </label>
                    <input name="dateDeNaissance" id="dateDeNaissance" type="date" class="form-control" onblur="verifDate(this)">
                
                    <label for="email">Adresse E-mail : </label>
                    <input name="email" id="email" type="email" placeholder="Veuillez entrer une adresse email" class="form-control" onblur="verifMail(this)">
                
                    <label for="adresse">Adresse Postale : </label>
                    <input name="adresse" id="adresse" type="text" placeholder="Veuillez entrer une adresse postale" class="form-control">
                
                    <label for="codePostal">Code Postal : </label>
                    <input name="codePostal" id="codePostal" type="text" placeholder="Veuillez entrer un code postal" class="form-control" onblur="verifCodePostal(this)">
                
                    <label for="ville">Ville : </label>
                    <input name="ville" id="ville" type="text" placeholder="Veuillez entrer une ville" class="form-control"  onblur="verifVille(this)">
                <input type="button" id="cancelBtn" value="Annuler" />
                <input type="submit" id="valideBtn" value="Valider" name="modifClient" />
        </form>

        </div>
    </body>
</html>