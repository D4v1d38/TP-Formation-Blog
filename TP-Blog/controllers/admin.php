<?php
//on demande la connexion à la base de données
require '../connexions/connect_bdd.php';
session_start();

//controle connexion admin
if(isset($_POST['pseudo-admin'], $_POST['pwd-admin'])){
    
    if(!empty($_POST['pseudo-admin']) && !empty($_POST['pwd-admin'])){
        
        $pseudoAdmin = htmlspecialchars($_POST['pseudo-admin']);
        $pwdAdmin = htmlspecialchars($_POST['pwd-admin']);
        
        $query = $bdd -> prepare('SELECT pseudo, password 
                                  FROM admin
                                  WHERE pseudo = ? ');
        
        $query->execute([$pseudoAdmin]);
        
        $adminData = $query->fetch();

        //Verifiaction des mots de passe fourni par le formulaire et celui de la BDD 
        
        if($adminData){
            
            if(password_verify($pwdAdmin, $adminData['password'])){
                $_SESSION['pseudoAdmin'] = $pseudoAdmin;
            }else{
                echo "votre mot de passe est incorrect";
            }
        }else{
            
                echo "votre pseudo n'existe pas";
        }
    }           
}
            
//On prepare une requete pour afficher tous les articles avec le nom de l'auteur et la catégorie à laquelle ils appartiennent.
    
            
$query = $bdd->prepare('SELECT id_article,titre,contenu,date, nom,prenom, nom_cat,image
                        FROM articles
                        INNER JOIN auteurs ON auteurs.id_auteur = articles.id_auteur
                        INNER JOIN categories ON categories.id_categorie = articles.id_cat
                        ORDER BY date DESC'
                        );  

//execution de la requete    
$query->execute();

//recupération des données

$listeDesArticles = $query->fetchAll();


$link = "../";

$template="admin";

require "../views/layout.phtml";


?>