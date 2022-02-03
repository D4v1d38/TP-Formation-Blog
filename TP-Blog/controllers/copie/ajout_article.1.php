<?php

//connexion a la BDD
require "../connexions/connect_bdd.php";


if(empty($_POST)){
    
    //requete pour recupération des auteurs
    $query = $bdd->prepare('SELECT id_auteur, nom, prenom
                        FROM auteurs ');

    $query->execute();

    $auteurs=$query->fetchAll();

    //requete pour recupération des categories
    
    $query = $bdd->prepare('SELECT id_categorie,nom_cat
                        FROM categories ');

    $query->execute();

    $categories = $query->fetchAll();    
}else{
    if(isset($_POST['titre'])&& !empty($_POST['titre'])){
        $titre = htmlspecialchars($_POST['titre']);
    }
    if(isset($_POST['contenu'])&& !empty($_POST['contenu'])){
        $contenu = htmlspecialchars($_POST['contenu']);
    }
    if(isset($_POST['choix-auteur']) && !empty($_POST['choix-auteur'])){
        $IdAuteur = htmlspecialchars($_POST['choix-auteur']);
    }
    if(isset($_POST['choix-categorie']) && !empty($_POST['choix-categorie'])){
        $IdCategorie = htmlspecialchars($_POST['choix-categorie']);
    }
    
    //preparation de la requete pour envoi vers la BDD
    
    $query = $bdd->prepare('INSERT INTO articles(titre, contenu, date, id_auteur, id_cat,image) 
                            VALUES (?,?,NOW(),?,?,?)');
    
    $query->execute([$titre,$contenu,$IdAuteur,$IdCategorie,$image]);
    
    header('location:admin.php');
}


$link = "../";

$template = "ajout_article";

require "../views/layout.phtml";

?>