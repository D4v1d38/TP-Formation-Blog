<?php
//on appel le fichier pour la connexion à la base de données

require 'connexions/connect_bdd.php';

// preparation de la requete

$query = $bdd->prepare('SELECT titre,contenu,date,nom, prenom,id_article,image
                        FROM articles
                        INNER JOIN auteurs ON auteurs.id_auteur = articles.id_auteur
                        ORDER BY date DESC');

//execution de la requête
$query->execute();

//récupération des données

$dataArticles = $query->fetchAll();


//on modifie l'url vers le CSS, dans le link css la variable $cssLink et concatener avec la suite de l'url pour s'adpter au chemin vers le css
$link="";


//appel du template

$template = "index";

//appel du layout
require "views/layout.phtml";


?>
