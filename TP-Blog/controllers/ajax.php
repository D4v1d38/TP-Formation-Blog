<?php 

    require "../connexions/connect_bdd.php";
    
    //recuperation des 5 derniers commentaires
    
    // $query = $bdd->prepare('SELECT contenu,pseudo, id_article 
    //                         FROM commentaires
    //                         ORDER BY date DESC 
    //                         LIMIT 5');
                            
                            
    $query=$bdd->prepare('SELECT pseudo, commentaires.contenu, titre, commentaires.id_article
                            FROM commentaires 
                            INNER JOIN articles ON commentaires.id_article = articles.id_article
                            ORDER BY commentaires.date DESC 
                            LIMIT 5');
                            
    $query->execute();
    
    $dataCom = $query->fetchAll();
    
    
    //on converti du format php au format JSON
    // echo json_encode($dataCom);
    
    require "../views/ajax.phtml";
?>


