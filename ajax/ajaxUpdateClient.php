<?php
require '../entities/client/clientManager.php';
if (isset($_POST['id']) && !empty(trim($_POST['id'])) && trim($_POST['action']) == 'update') 
{
    $idToUpdate = trim($_POST['id']);
    $idToUpdate = (int)$idToUpdate;
    $pdo = Database::connect();
    $manager = new ClientManager($pdo);
    $donnees = $manager->update($idToUpdate);
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
    $manager->updateClient($client);
    Database::disconnect();
}
else
{
    header("Location: ../index.php");
}