<!DOCTYPE html>
<html>
 <head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1">
     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
     <link rel="stylesheet" href="/projetbiblio/css/style.css">
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
     <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
     <script src="/projetbiblio/js/form.js"></script>
     <script src="/projetbiblio/js/filterTable/jquery.filtertable.js"></script>
     
     <div class="row" style="background-color:#202020">
         <span class="col-lg-3"></span><img class="col-lg-6" src="/projetbiblio/images/logo_biblio.png" height="420" />
     </div>
     
     <nav class="navbar navbar-inverse">
        <div class="container-fluid">
            <div class="navbar-header">
                <span class= "active navbar-brand" >Bibliotheque</span>
            </div> 
        <ul class="nav navbar-nav">
            <li><a href="/projetbiblio/index.php">Accueil</a></li>
            <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">Client
                <span class="caret"></span></a>
                <ul class="dropdown-menu">
                    <li><a href="/projetbiblio/html/creationClient.php">Creation client</a></li>
                    <li><a href="/projetbiblio/html/gestionClient.php">Gestion client</a></li>
                </ul>
            </li>
           <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">Livre
                <span class="caret"></span></a>
                <ul class="dropdown-menu">
                    <li><a href="/projetbiblio/html/creationLivre.php">Creation livre</a></li>
                    <li><a href="/projetbiblio/html/gestionLivre.php">Gestion livre</a></li>
                </ul>
            </li>    
               <li>
                <a href="/projetbiblio/html/creationEmprunt.php">Emprunt</a>
               </li> 
        </ul>
        </div>        
     </nav>
 
     