<?php
require_once "../entities/emprunt/empruntManager.php";
require_once "../entities/client/clientManager.php";
require_once "../entities/livre/livreManager.php";
include "../header.php";
$pdo = Database::connect();
$clientManager = new ClientManager($pdo);
$livreManager = new LivreManager($pdo);
?>
<title>Projet Bibiotheque - Creation Emprunt</title>
</head>
    <body>
        <form class="col-lg-6" action="../html/traitementEmprunt.php" method="POST">
            <legend>Création emprunt</legend>    
                <div class="form-group">
                    <label for="client">Client : </label>
                    <select name="client" id="client">
                        <?php
                        $clients = $clientManager->getList();
                        
                        foreach ($clients as $unClient)
                        {
                            $infos = $unClient->nom() ." ". $unClient->prenom() ." - ". $unClient->email();
                            echo '<option value="' .$unClient->idClient(). '">' .$infos. '</option>';
                        }
                        ?>
                    </select> 
                </div>
                <div class="form-group">
                    <label for="isbn">Livre : </label>
                    <select name="livre" id="livre">
                        <?php
                        $livres = $livreManager->getListDispo();
                        
                        foreach($livres as $unLivre)
                        {
                            $infos = $unLivre->titre() ." - ". $unLivre->isbn();
                            echo '<option value="' .$unLivre->idLivre().'">' .$infos. '</option>';
                        }
                        Database::disconnect();
                        ?>
                    </select>
                </div>
                <button type="submit" class="btn btn-default">Emprunter</button>
        </form>
    </body>
</html>