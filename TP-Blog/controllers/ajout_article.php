<?php
session_start();
if(isset($_SESSION['pseudoAdmin'])){

    //connexion a la BDD
    require "../connexions/connect_bdd.php";

    //si le formulaire n'est pas soumis
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
        
        $link = "../";
    
        $template = "ajout_article";
    
        require "../views/layout.phtml";
    }else{
    
        if(isset($_POST['titre'], $_POST['contenu'], $_POST['choix-auteur'], $_POST['choix-categorie'], $_FILES['image']) && $_FILES['image']['error']==0 && !empty($_POST['titre']) && !empty($_POST['contenu']) && !empty($_POST['choix-auteur']) && !empty($_POST['choix-categorie'])){
        
            $titre = htmlspecialchars($_POST['titre']);
            $contenu = htmlspecialchars($_POST['contenu']);
            $IdAuteur = htmlspecialchars($_POST['choix-auteur']);
            $IdCategorie = htmlspecialchars($_POST['choix-categorie']);
            
            /*Gestion des images*/
            $informationsImage = pathinfo($_FILES["image"]["name"]); //recuperation des infos de l'image grace a pathinfo
            $extensionImage = $informationsImage["extension"]; //extension de notre image
            $extensionsArray = array("png","PNG", "gif","GIF","jpg","JPG","jpeg",'JPEG'); //on defini untableau avec les extensions que l'on accepte
            
                if(in_array($extensionImage, $extensionsArray)){ //on verifie si l'extension du fichier est présente dans notre array d'extension acceptée
            
                    $image = htmlspecialchars($_FILES["image"]["name"]); // On récupère le nom du fichier
                
                    move_uploaded_file($_FILES["image"]["tmp_name"],"../images/".$image); //On tranfert l' image de son dossier temporaire vers notre dossier sur le serveur
                }
        }
    
    //preparation de la requete pour envoi vers la BDD
    
    $query = $bdd->prepare('INSERT INTO articles(titre, contenu, date, id_auteur, id_cat, image) 
                            VALUES (?,?,NOW(),?,?,?)');
    
    $query->execute([$titre,$contenu,$IdAuteur,$IdCategorie,$image]);
    
    header('location:admin.php');

    }
    
}else{
    
    header('location:admin.php');
    exit();
}

?>