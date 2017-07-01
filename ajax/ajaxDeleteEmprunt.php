<?php
require '../entities/emprunt/empruntManager.php';
if(isset($_POST['id']) && !empty($_POST['id']))
{
    $idToDelete = (int)trim($_POST['id']);
    $pdo = Database::connect();
    $manager = new EmpruntManager($pdo);
    $manager->delete($idToDelete);
    Database::disconnect();
}
else
{
    header("Location: ../index.php");
}    
