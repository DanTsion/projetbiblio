<?php
require_once '../entities/emprunt/empruntManager.php';
include '../header.php';
$pdo = Database::connect();
$manager = new EmpruntManager($pdo);
?>

<title>Gestion Emprunt</title>
<script type="text/javascript" src="../js/regexemprunt.js"></script>
<script src="../js/gestionEmprunt.js"></script>
<link rel="stylesheet" href="../css/dialog.css"/>
</head>
    <body>
        <div class="container">
            <div class="row">
                <a href="../html/creationEmprunt.php" class="btn btn-success">Déclarer un emprunt</a>
            </div><br/>
            <div class="row">
                <div class="table-reponsive">
                    <table class="table table-hover table-bordered">
                        <thead>
                            <th>Nom</th>
                            <th>Prénom</th>
                            <th>Adresse Email</th>
                            <th>Nombre emprunt</th>
                        </thead>
                            <tbody>
<?php
$emprunts = $manager->getList();

if(empty($emprunts))
{
    echo '<script>alert("Aucun emprunt repertorié);</script>';
}
else
{
    foreach($emprunts as $unemprunt)
    {
        echo '<tr>';
        echo '<td>' . $unemprunt->client()->nom() . '</td>';
        echo '<td>' . $unemprunt->client()->prenom . '</td>';
        echo '<td>' . $unemprunt->email() . '</td>';
        echo '<td>' . $unemprunt->count() . '</td>';
        echo '<td><button class="btn btn-danger" value="' .$unLivre->idLivre() . '">Supprimer</button></td>';
        echo '</tr>';
    }
}

Database::disconnect();
