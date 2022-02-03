<?php
session_start();
    
    if(isset($_SESSION['pseudoAdmin'])){
        //connexion a la BDD
        require "../connexions/connect_bdd.php";   
        
        if(isset($_POST['user-pseudo'], $_POST['user-pwd'])){
            
            if(!empty($_POST['user-pseudo']) && !empty($_POST['user-pwd'])){
                
                $userPseudo = htmlspecialchars($_POST['user-pseudo']);
                $userPwd = htmlspecialchars($_POST['user-pwd']);
                
                
                $mdp = password_hash($userPwd, PASSWORD_DEFAULT);
                
                $query = $bdd->prepare('INSERT INTO admin (pseudo, password)
                        VALUES (?,?)');
                        
                $query->execute([$userPseudo,$mdp]);
                
                header('location:admin.php');
            }
        }
        
        
        $link='../';
        
        $template="new_user";
        
        require '../views/layout.phtml';
        
    }else{
        header('location:admin.php');
        exit();
    }
    
    
    
?>