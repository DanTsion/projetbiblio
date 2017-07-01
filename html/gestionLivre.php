<?php
require_once '../entities/livre/livreManager.php';
require_once "../entities/client/clientManager.php";
require_once "../entities/emprunt/empruntManager.php";
include '../header.php';
$pdo = Database::connect();
$manager = new LivreManager($pdo);

if(isset($_POST['creerLivre']) 
    && isset($_POST['titre']) && !empty(trim($_POST['titre']))
    && isset($_POST['auteur']) && !empty(trim($_POST['auteur']))
    && isset($_POST['editeur']) && !empty(trim($_POST['editeur']))
    && isset($_POST['dateDeParution']) && !empty(trim($_POST['dateDeParution']))
    && isset($_POST['isbn']) && !empty(trim($_POST['isbn'])))
{
    $livre = new Livre([
        'titre' => trim($_POST['titre']),
        'auteur' => trim($_POST['auteur']),
        'editeur' => trim($_POST['editeur']),
        'dateDeParution' => trim($_POST['dateDeParution']),
        'isbn' => trim($_POST['isbn'])
        ]);
        $manager->addLivre($livre);
}
elseif(isset($_POST['modifLivre'])
    && isset($_POST['titre']) && !empty(trim($_POST['titre']))
    && isset($_POST['auteur']) && !empty(trim($_POST['auteur']))
    && isset($_POST['editeur']) && !empty(trim($_POST['editeur']))
    && isset($_POST['dateDeParution']) && !empty(trim($_POST['dateDeParution']))
    && isset($_POST['isbn']) && !empty(trim($_POST['isbn'])))
{
    $livre = new Livre([
        'idLivre' => trim($_POST['idLivre']),
        'titre' => trim($_POST['titre']),
        'auteur' => trim($_POST['auteur']),
        'editeur' => trim($_POST['editeur']),
        'dateDeParution' => trim($_POST['dateDeParution']),
        'isbn' => trim($_POST['isbn'])
        ]);
        
    $manager->updateLivre($livre);
}
elseif(isset($_POST['empruntLivre'])
    && isset($_POST['idLivre']) && !empty(trim($_POST['idLivre']))
    && isset($_POST['selectClient']) && !empty(trim($_POST['selectClient'])))
{
    //Instancier livre
    $idLivre = (int)trim($_POST['idLivre']);
    $donneesLivre = $manager->get($idLivre);
    $livre = new Livre([
        'idLivre' => trim($donneesLivre['idLivre']),
        'titre' => trim($donneesLivre['titre']),
        'auteur' => trim($donneesLivre['auteur']),
        'editeur' => trim($donneesLivre['editeur']),
        'dateDeParution' => trim($donneesLivre['dateDeParution']),
        'isbn' => trim($donneesLivre['isbn'])
        ]);
        
    Database::disconnect();
    
    //Instancier Client
    $pdo = Database::connect();
    $clientManager = new ClientManager($pdo);
    $idClient = (int)trim($_POST['selectClient']);
    $donneesClient = $clientManager->get($idClient);
    $client = new Client([
        'idClient' => trim($donneesClient['idClient']),
        'nom' => trim($donneesClient['nom']),
        'prenom' => trim($donneesClient['prenom']), 
        'dateDeNaissance' => trim($donneesClient['dateDeNaissance']),
        'email' => trim($donneesClient['email']),
        'adresse' => trim($donneesClient['adresse']),
        'codePostal' => trim($donneesClient['codePostal']),
        'ville' => trim($donneesClient['ville'])
        ]);
    Database::disconnect();
    
    //Instancier emprunt et l'ajouter en base
    $pdo = Database::connect();
    $empruntManager = new EmpruntManager($pdo);
    $emprunt = new Emprunt([
        'client' => $client,
        'livre' => $livre
        ]);
    $empruntManager->addEmprunt($emprunt);
}
?>

<title>Gestion livre</title>
<script src="../js/gestionLivre.js"></script>
<script src="../js/filterTable/jquery.filtertable.js"></script>
<link rel="stylesheet" href="../css/dialog.css"/>
</head>
    <body>
        <div class="container">
            <div class="row">
                <a href="../html/creationLivre.php" class="btn btn-success">Ajouter un livre</a>
            </div><br/>
            <div class="row">
                <div class="table-reponsive">
                    <table id="listeLivres" class="table table-hover table-bordered">
                        <thead>
                            <th>Titre</th>
                            <th>Auteur</th>
                            <th>Editeur</th>
                            <th>Annee de parution</th>
                            <th>ISBN</th>
                            <th colspan="3">Gestion</th>
                        </thead>
                            <tbody>
<?php
$livres = $manager->getList();


if(empty($livres))
{
    echo '<script>alert("Aucun livre repertorié);</script>';
}
else
{
    foreach($livres as $unLivre)
    {
        echo '<tr>';
        echo '<td>' . $unLivre->titre() . '</td>';
        echo '<td>' . $unLivre->auteur() . '</td>';
        echo '<td>' . $unLivre->editeur() . '</td>';
        echo '<td>' . date_format(date_create($unLivre->dateDeParution()), "d/m/Y") . '</td>';
        echo '<td>' . $unLivre->isbn() . '</td>';
        echo '<td><button class="btn btn-primary" value="' .$unLivre->idLivre() . '">Modifier</button></td>';
        echo '<td><button class="btn btn-danger" value="' .$unLivre->idLivre() . '">Supprimer</button></td>';
        if($unLivre->dispo()==0)
        {
            echo '<td><button class="btn btn-warning" value="' .$unLivre->idLivre() . '">Retourner</button></td>';
        }
        else
        {
            echo '<td><button class="btn btn-info" value="' .$unLivre->idLivre() . '">Emprunter</button></td>';
        }
        
        echo '</tr>';
    }
}

Database::disconnect();
?>
                            </tbody>
                    </table>
                </div>
            </div>
        </div>
        
        <div id="updatediv">
            <form class="form col-lg-offset-3 col-lg-5" action="" id="update" method="POST" onsubmit="verifForm(this)">
            <img src="../images/button_cancel.png" class="img" id="cancel"/>
                <legend>Modification d'un livre</legend>
                        <input name="idLivre" id="idLivre" type="hidden">
                    
                        <label for="titre">Titre : </label>
                        <input name="titre" id="titre" type="text" placeholder="Veuillez entrer un Titre de livre" class="form-control" onblur="verifTitre(this)">
                    
                        <label for="auteur">Auteur : </label>
                        <input name="auteur" id="auteur" type="text" placeholder="Veuillez entrer un Auteur" class="form-control" onblur="verifAuteur(this)">
                   
                        <label for="editeur">Editeur : </label>
                        <input name="editeur" id="editeur" type="text" placeholder="Veuillez entrer un Editeur" class="form-control" onblur="verifEditeur(this)">
                   
                        <label for="dateDeParution">Année de Parution : </label>
                        <input name="dateDeParution" id="dateDeParution" type="date" class="form-control" onblur="verifDateDeParution(this)">
                    
                        <label for="isbn">N° ISBN : </label>
                        <input name="isbn" id="isbn" type="text" placeholder="Veuillez entrer un Isbn" class="form-control" onblur="verifIsbn(this)">
                    
                <input type="button" id="cancelBtn" value="Annuler"/>    
                <input type="submit" id="valideBtn" value="Valider" name="modifLivre"/>
            </form>
        </div>
        
        <?php
        $pdo = Database::connect();
        $clientManager = new ClientManager($pdo);
        ?>
        <div id="empruntdiv">
            <form class="form col-lg-offset-3 col-lg-5" action="" id="emprunt" method="POST">
            <img src="../images/button_cancel.png" class="img" id="cancelimg"/>
                <legend>Qui souhaite emprunter ce livre?</legend>
                    <div class="form-group">
                        <label for="titre" id="livreToBorrow"></label>
                    </div>
                        <input name="idLivre" id="idLivreToBorrow" type="hidden">
                    
                        <label>Client souhaitant emprunter : </label>
                        <select name="selectClient" id="selectClient">
                        <?php
                        $clients = $clientManager->getList();
                        
                        foreach ($clients as $unClient)
                        {
                            $infos = $unClient->nom() ." ". $unClient->prenom() ." - ". $unClient->email();
                            echo '<option value="' .$unClient->idClient(). '">' .$infos. '</option>';
                        }
                        ?>
                    </select> 
                    
                <input type="button" id="cancelBtn" value="Annuler"/>    
                <input type="submit" id="valideEmprunt" value="Valider" name="empruntLivre"/>
            </form>
        </div>
        
    </body>
</html>
