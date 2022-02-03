<?php 
    session_start();
    
    if(isset($_SESSION['pseudoAdmin'])){
        //on appel le fichier pour la base de connexion
        require '../connexions/connect_bdd.php';
    
        //on verifie les données envoyés par le lien venant de la page index.phtml
        //la variable $idArticle sera mise dans value="" du champ caché du formulaire pour recuperation de l'id de l'article
        
        if(array_key_exists('id_article',$_GET) && is_numeric($_GET['id_article'])){
            
            $idArticle = htmlspecialchars($_GET['id_article']);
        }
    
        //si le formulaire n'est pas soumis
        
        if(empty($_POST)){
            //on recup un seul article du blog avec une condition WHERE
            
            $query = $bdd->prepare('SELECT id_article, titre, contenu,image
                                    FROM articles 
                                    WHERE id_article = ?
                                  ');
                                  
            $query->execute([$idArticle]);
            
            $articlePourModif= $query->fetch();
            // var_dump( $articlePourModif);
            
            
            //on modifie le chemin pour lier le fichier CSS
            $link = "../";
        
            //on defini  le template associé
            $template = "modif_article";
        
            //on appel le layout
            require "../views/layout.phtml";
        }
        else{
    
            // traitement des données recu par le formulaire
            if(isset($_POST['titre'], $_POST['contenu'], $_POST['id_article'])  && !empty($_POST['titre']) && !empty($_POST['contenu']) && !empty($_POST['id_article'])){
               
                
                $titreUpDate = htmlspecialchars($_POST['titre']);
                $contenuUpDate = htmlspecialchars($_POST['contenu']);
                $idArticleUpDate = htmlspecialchars($_POST['id_article']);
                
                //Gestion des images
                if(isset($_FILES['image']) && $_FILES['image']['error']==0 ){
                    
                
                    $informationsImage = pathinfo($_FILES["image"]["name"]); //recuperation des infos de l'image grace a pathinfo
                    $extensionImage = $informationsImage["extension"]; //extension de notre image
                    $extensionsArray = array("png","PNG", "gif","GIF","jpg","JPG","jpeg",'JPEG'); //on defini untableau avec les extensions que l'on accepte
                    
                    if(in_array($extensionImage, $extensionsArray)){//on verifie si l'extension du fichier est présente dans notre array d'extension acceptée
                    
                        $image = htmlspecialchars($_FILES["image"]["name"]); // On récupère le nom du fichier
                        
                        move_uploaded_file($_FILES["image"]["tmp_name"],"../images/".$image); //On tranfert l' image de son dossier temporaire vers notre dossier sur le serveur
                    }
                
                
                    //Préparation requete pour mise a jour dans la table de la BDD
                    $query = $bdd->prepare('UPDATE articles 
                                            SET titre=?,contenu=?,image=?
                                            WHERE id_article =? 
                                          ');
                                      
                    $query->execute([$titreUpDate,$contenuUpDate,$image,$idArticleUpDate]);
                }else{
                    $query = $bdd->prepare('UPDATE articles 
                                            SET titre=?,contenu=?
                                            WHERE id_article =? 
                                        ');
                                      
                    $query->execute([$titreUpDate,$contenuUpDate,$idArticleUpDate]);
                }
                
                header("location:admin.php");
                exit();
                
            }else{
                
                header("location:admin.php");
                exit();
            }
        }    
    }else{
        
        header("location:admin.php");
        exit();
    }
    

?>

