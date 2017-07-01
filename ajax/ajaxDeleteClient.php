<?php
require '../entities/client/clientManager.php';
if (isset($_POST['id']) && !empty(trim($_POST['id'])))
{
    $idToDelete = trim($_POST['id']);
    $idToDelete = (int)$idToDelete;
    $pdo = Database::connect();
    $manager = new ClientManager($pdo);
    $donnees = $manager->get($idToDelete);
    $client = new Client([
        'idClient' => $donnees['idClient'],
        'nom' => $donnees['nom'],
        'prenom' => $donnees['prenom'], 
        'dateDeNaissance' => $donnees['dateDeNaissance'],
        'email' => $donnees['email'],
        'adresse' => $donnees['adresse'],
        'codePostal' => $donnees['codePostal'],
        'ville' => $donnees['ville']
        ]);
    $manager->delete($client);
    Database::disconnect();
}
else
{
    header("Location: ../index.php");
}