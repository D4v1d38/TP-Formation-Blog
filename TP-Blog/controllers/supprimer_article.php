<?php
session_start();
if(isset($_SESSION['pseudoAdmin'])){
    require "../connexions/connect_bdd.php";

    //controle des données recus par URL

    if(array_key_exists('id_article',$_GET) && is_numeric($_GET['id_article'])){
    
        $idArticleToDelete = htmlspecialchars($_GET['id_article']);
        //  var_dump($idArticleToDelete);
    }

    $query = $bdd->prepare('DELETE 
                        FROM articles 
                        WHERE id_article=?');
                        
    $query->execute([$idArticleToDelete]);


    header("location:admin.php");
    
}else{
    
    header("location:admin.php");
    exit();
    
}

?>