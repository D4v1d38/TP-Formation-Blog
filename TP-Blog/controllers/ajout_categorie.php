<?php 
session_start();

if(isset($_SESSION['pseudoAdmin'])){
    
    require "../connexions/connect_bdd.php";
    
    if(isset($_POST['categorie']) && !empty($_POST['categorie'])){
        
        $newCategory = htmlspecialchars($_POST['categorie']);
        
        $query = $bdd->prepare('INSERT INTO categories(nom_cat) 
                                VALUES (?)');
        
        $query->execute([$newCategory]);
        
        header('location:admin.php');
    
    }
    
    
    $link= "../";
    
    $template= "ajout_categorie";
    
    require "../views/layout.phtml";
    
    
    
}else{
    header('location:admin.php');
}

?>