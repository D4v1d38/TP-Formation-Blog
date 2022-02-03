<?php
require "../connexions/connect_bdd.php";

$pseudo ="David";
$mdp = password_hash('Novembre2021', PASSWORD_DEFAULT);

$query = $bdd->prepare('INSERT INTO admin (pseudo, password)
                        VALUES (?,?)');
                        
$query->execute([$pseudo,$mdp]);

?>