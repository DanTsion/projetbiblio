<?php
require '../entities/livre/livreManager.php';
if (isset( $_POST['id']) && $_POST['action'] == 'delete') 
{
    $idToDelete = trim($_POST['id']);
    $idToDelete = (int)$idToDelete;
    $pdo = Database::connect();
    $manager = new LivreManager($pdo);
    $donnees = $manager->get($idToDelete);
    $livre = new Livre([
        'idLivre' => $donnees['idLivre'],
        'titre' => $donnees['titre'],
        'auteur' => $donnees['auteur'],
        'editeur' => $donnees['editeur'],
        'dateDeParution' => $donnees['dateDeParution'],
        'ISBN' => $donnees['ISBN']
        ]);
    $manager->delete($livre);
    Database::disconnect();
}
else
{
    header("location: ../index.php");
}