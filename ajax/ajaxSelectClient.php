<?php
require '../entities/client/clientManager.php';
if(isset($_POST['id']) && !empty(trim($_POST['id'])))
{
    $idToGet = trim($_POST['id']);
    $idToGet = (int)$idToGet;
    $pdo = Database::connect();
    $manager = new ClientManager($pdo);
    $donnees = $manager->get($idToGet);
    Database::disconnect();
    echo json_encode($donnees);
}
else
{
    header("Location: ../index.php");
}