<?php
include "../header.php";
require_once "../entities/livre/livreManager.php";
?>
    <title>Projet Bibliotheque - Creation Livre</title>
    <script type="text/javascript" src="../js/regexlivre.js"></script>
</head>
    <body>
        <form class="col-lg-3" action="../html/gestionLivre.php" method="POST" onsubmit="return verifForm(this)" >
            <legend>Creation d'un livre</legend>
                <div class="form-group">
                    <label for="titre">Titre : </label>
                    <input name="titre" id="titre" type="text" placeholder="Veuillez entrer un Titre de livre" class="form-control" onblur="verifTitre(this)">
                    <span id="titreError"></span>
                </div>
                <div class="form-group">
                    <label for="auteur">Auteur : </label>
                    <input name="auteur" id="auteur" type="text" placeholder="Veuillez entrer un Auteur" class="form-control" onblur="verifAuteur(this)">
                    <span id="auteurError"></span>
                </div>
                <div class="form-group">
                    <label for="editeur">Editeur : </label>
                    <input name="editeur" id="editeur" type="text" placeholder="Veuillez entrer un Editeur" class="form-control" onblur="verifEditeur(this)">
                    <span id="editeurError"></span>
                </div>
                <div class="form-group">
                    <label for="dateDeParution">Date de Parution : </label>
                    <input name="dateDeParution" id="dateDeParution" type="date" class="form-control" onblur="verifDateDeParution(this)">
                    <span id="dateDeParutionError"></span>
                </div>
                <div class="form-group">
                    <label for="isbn">N° ISBN : </label>
                    <input name="isbn" id="isbn" type="text" placeholder="Veuillez entrer un Isbn" class="form-control" onblur="verifISBN(this)">
                    <span id="isbnError"></span>
                </div>
                <input type="submit" value="Valider" name="creerLivre"/>
        </form>
    </body>
    
</html>