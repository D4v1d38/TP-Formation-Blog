<?php

// ajout de la connexion a la base de données

require '../connexions/connect_bdd.php';

//traitements des données recues par le formulaire

if(!empty($_POST['id_article']) && !empty($_POST['pseudo']) && !empty($_POST['messages']) ){
    if(isset($_POST['id_article']) && !empty($_POST['id_article'])){
    
        $idArticle = htmlspecialchars($_POST['id_article']);
    }

    if(isset($_POST['pseudo']) && !empty($_POST["pseudo"])){
    
        $pseudo = htmlspecialchars($_POST["pseudo"]);
    
    }

    if(isset($_POST['messages']) && !empty($_POST['messages'])){
    
        $messages = htmlspecialchars($_POST['messages']);
    }
    
    //preparation de la requête
    $query = $bdd->prepare('INSERT INTO commentaires( id_article, pseudo, contenu, date) 
                        VALUES (?,?,?,NOW())');

    $query->execute([$idArticle,$pseudo,$messages]);

    header("location:article.php?id_article=".$idArticle);

    
}else{
    header("location:article.php?id_article=".htmlspecialchars($_POST['id_article']));
    
}




?>