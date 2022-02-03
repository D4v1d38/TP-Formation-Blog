<?php 

    session_start();
    
    if(isset($_SESSION['pseudoAdmin'])){
        
        require "../connexions/connect_bdd.php";
        
        if(isset($_POST['nom'],$_POST['prenom']) && !empty($_POST['nom']) && !empty($_POST['prenom'])){
            
            $nomAuteur = htmlspecialchars($_POST['nom']);
            $prenomAuteur = htmlspecialchars($_POST['prenom']);
            
            $query= $bdd->prepare('INSERT INTO auteurs(nom, prenom) 
                             VALUES (?,?)');
                             
            $query->execute([$nomAuteur,$prenomAuteur]);
            
             header('location:admin.php');
        }
        
    $link= "../";
    
    $template= "ajout_auteur";
    
    require "../views/layout.phtml";
    
   
        
        
    }else{
        
        header('location:admin.php');
    }

?>