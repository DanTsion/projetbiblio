<?php 
require_once '../entities/livre/livreManager.php';
require_once "../entities/client/clientManager.php";
require_once "../entities/emprunt/empruntManager.php";
if(isset($_POST['livre']) && isset($_POST['client'])
    && !empty(trim($_POST['livre'])) && !empty(trim($_POST['client'])))
{
  
    $pdo = Database::connect();
    $clientManager = new ClientManager($pdo);
    $idClient = (int)trim($_POST['client']);
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
    
    
    $pdo = Database::connect();
    $livreManager = new LivreManager($pdo);
    $idLivre = (int)trim($_POST['livre']);
    $donneesLivre = $livreManager->get($idLivre);
    $livre = new Livre([
        'idLivre' => trim($donneesLivre['idLivre']),
        'titre' => trim($donneesLivre['titre']),
        'auteur' => trim($donneesLivre['auteur']),
        'editeur' => trim($donneesLivre['editeur']),
        'dateDeParution' => trim($donneesLivre['dateDeParution']),
        'isbn' => trim($donneesLivre['isbn'])
        ]);
    Database::disconnect();
    
    $pdo = Database::connect();
    $empruntManager = new EmpruntManager($pdo);
    $emprunt = new Emprunt([
        'client' => $client,
        'livre' => $livre
        ]);
    $empruntManager->addEmprunt($emprunt);
    
    header("location: ../html/gestionLivre.php");
}
else
{
    header("location: ../index.php");
}