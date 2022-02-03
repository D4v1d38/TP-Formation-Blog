//2-Fonctions d'appel

function onLoadComments(){
    $.get('controllers/ajax.php',afficherComments);
}


//3 Fonction callback pour afficher les commentaires

function afficherComments(donnees){
    
    //conversion du JSON en JS
    // donnees = JSON.parse(donnees);
    $('#target').empty();
    // $('#target').append('<h3>Les Derniers commentaires</h3>');
    
    // for(const item of donnees){
        // $('#target').append('<li> <i class="fas fa-chevron-circle-right"></i>' + item['contenu'] + " <i class='fas fa-user-alt'></i> par " +'<span class="pseudo-color">' +item['pseudo'] +'</span>'+ "</li>");
        
        // $('#target').append('<a href="./controllers/article.php?id_article=<?=htmlspecialchars($item[\'id_article\']) ?>" ><li>' + item['contenu'] +'</a>' + "  par " +'<span class="pseudo-color">' +item['pseudo'] +'</span>'+ "</li>");
        //html
        
       
        
    // }
    
     $('#target').html(donnees);
    
    setTimeout(onLoadComments,5000);
    
}


//1-evenement au chargement de la page

$(function(){
    
   onLoadComments();
    
})