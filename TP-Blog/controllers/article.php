<?php

//appel de la connexion à la BDD
require '../connexions/connect_bdd.php';

//on verifie les donnés envoyés par l'url (titre cliquable sur index.phtml)
if(array_key_exists('id_article',$_GET)&& is_numeric($_GET['id_article'])){
    
    $idArticle =$_GET['id_article'];
}


// preparation de la requete pour afficher l'article en entier
$query = $bdd->prepare('SELECT titre,contenu,date, nom, prenom, image
                        FROM articles
                        INNER JOIN auteurs ON auteurs.id_auteur = articles.id_auteur
                        WHERE id_article = ?');

//exécution de la requete en parametre on passe articleID transmis par le lien(sur index.html), que l'on a verifié et ranger dans la variable $idArticle (lignes 7 a 10)                     
$query->execute([$idArticle]);

//réception des données
$articleSelect = $query->fetch();

// preparation et execution de la requete pour afficher les commentaires.

$query = $bdd->prepare('SELECT pseudo,contenu,date, id_article
                        FROM commentaires
                        WHERE id_article = ?
                        ORDER BY date DESC
                        ');

$query->execute([$idArticle]);

$commentsArticle = $query->fetchAll();


//on modifie l'url vers le CSS, dans le link css la variable $cssLink et concatener avec la suite de l'url pour s'adpter au chemin vers le css
$link = "../";

//appel du template pour la page article (articles.phtml) qui affiche les données concerant l'article
$template = "article";

//appel du layout qui se charge d'afficher les parties fixes du site
require "../views/layout.phtml";

?>