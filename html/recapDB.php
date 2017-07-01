<?php
require "../entities/client/clientManager.php";
require "../entities/livre/livreManager.php";
require "../entities/emprunt/empruntManager.php";
$pdo = Database::connect();
$clientManager = new ClientManager($pdo);
$livreManager = new LivreManager($pdo);
$empruntManager = new EmpruntManager($pdo);
?>
<!DOCTYPE html>
<html>
    <?php
    echo 'Nombre de clients en base de données: '.$clientManager->count();
    echo '<br/>';
    echo 'Nombre total de livres dans la bibliothèque: '.$livreManager->count();
    echo '<br/>';
    echo 'Nombre total de livres empruntés: ' .$livreManager->countEmprunts();
    echo '<br/>';
    echo 'Dernier livre emprunté: ' .$empruntManager->dernierEmprunt();
    ?>
</html>