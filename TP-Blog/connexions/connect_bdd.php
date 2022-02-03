<?php

//connexion à la base de données
try{
    
    $bdd = new PDO('mysql:host=db.3wa.io;dbname=davidrotolo_blog;charset=utf8','davidrotolo','1dab2f9c1a3dc3f96a1229b7f7684115');

    
}
catch(Exception $e){
    die("Message d'erruer suivant : " .$e->getMessage());
}
