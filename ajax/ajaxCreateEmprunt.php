<?php
require_once '../entities/livre/livreManager.php';
require_once "../entities/client/clientManager.php";
require_once "../entities/emprunt/empruntManager.php";
if(isset($_POST['idClient']) && isset($_POST['idLivre'])
    && !empty(trim($_POST['idClient'])) && !empty(trim($_POST['idLivre'])))
{
    $pdo = Database::connect();
    $clientManager = new ClientManager($pdo);
    $idClient = (int)trim($_POST['idClient']);
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
    $idLivre = (int)trim($_POST['idLivre']);
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
}
else {
    header("location: ../index.php");
}