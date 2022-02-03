<?php

// ajout de la connexion a la base de données

require '../connexions/connect_bdd.php';

//traitements des données recues par le formulaire

if(!empty($_POST['id_article']) && !empty($_POST['pseudo']) && !empty($_POST['messages']) && 
    isset($_POST['id_article'],$_POST['pseudo'],$_POST['messages'])){
    
        $idArticle = htmlspecialchars($_POST['id_article']);
        $pseudo = htmlspecialchars($_POST["pseudo"]);
        $messages = htmlspecialchars($_POST['messages']);
 
    
    //preparation de la requête
    $query = $bdd->prepare('INSERT INTO commentaires( id_article, pseudo, contenu, date) 
                        VALUES (?,?,?,NOW())');

    $query->execute([$idArticle,$pseudo,$messages]);

    header("location:article.php?id_article=".$idArticle);

    
}else{
    header("location:article.php?id_article=".htmlspecialchars($_POST['id_article']));
    
}



?>