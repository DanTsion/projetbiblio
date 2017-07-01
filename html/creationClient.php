<?php
require_once "../entities/client/clientManager.php";
include "../header.php";
?>
<title>Projet Bibliotheque - Creation Client</title>
    <script type="text/javascript" src="../js/regexclient.js"></script>
</head>
    <body>
        <form class="col-lg-6" action="../html/gestionClient.php" method="POST" onsubmit="return verifForm(this)">
            <legend>Création d'un client</legend>
                <div class="form-group">
                    <label for="nom">Nom : </label>
                    <input name="nom" id="nom" type="text" placeholder="Veuillez entrer un nom (en majuscules)" class="form-control" onblur="verifNomClient(this)">
                    <span id="nomError"></span>
                </div>
                <div class="form-group">
                    <label for="prenom">Prénom : </label>
                    <input name="prenom" id="prenom" type="text" placeholder="Veuillez entrer un prenom" class="form-control" onblur="verifPrenomClient(this)">
                    <span id="prenomError"></span>
                </div>
                <div class="form-group">
                    <label for="dateDeNaissance">Date de Naissance : </label>
                    <input name="dateDeNaissance" id="dateDeNaissance" type="date" class="form-control" onblur="verifDate(this)">
                    <span id="dateError"></span>
                </div>
                <div class="form-group">
                    <label for="email">Adresse E-mail : </label>
                    <input name="email" id="email" type="email" placeholder="Veuillez entrer une adresse email" class="form-control" onblur="verifMail(this)">
                    <span id="emailError"></span>
                </div>
                <div class="form-group">
                    <label for="adresse">Adresse Postale : </label>
                    <input name="adresse" id="adresse" type="text" placeholder="Veuillez entrer une adresse postale" class="form-control" onblur="verifAdresse(this)">
                    <span id="adresseError"></span>
                </div>
                <div class="form-group">
                    <label for="codePostal">Code Postal : </label>
                    <input name="codePostal" id="codePostal" type="text" placeholder="Veuillez entrer un code postal" class="form-control" onblur="verifCodePostal(this)">
                    <span id="codePostalError"></span>
                </div>
                <div class="form-group">
                    <label for="ville">Ville : </label>
                    <input name="ville" id="ville" type="text" placeholder="Veuillez entrer une ville (en majuscules)" class="form-control" onblur="verifVille(this)">
                    <span id="villeError"></span>
                </div>
                <input type="submit" value="Valider" name="creerClient" />
        </form>
    </body>
</html>