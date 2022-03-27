<?php

//connexion à la base de données
try{
    
    $bdd = new PDO('mysql:host=***host***;dbname=davidrotolo_blog;charset=utf8','***username***','***password***');

    
}
catch(Exception $e){
    die("Message d'erruer suivant : " .$e->getMessage());
}
