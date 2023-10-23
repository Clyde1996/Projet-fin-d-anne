

<h1>Hey</h1>
<?php



$favoris = $result["data"]["favoris"];
// $userFavoris = $result["data"]["userFavoris"];

if(App\Session::getUser()){


    foreach($favoris as $favori){
        ?>
        <div class="card">
        <p ><?=$favori->getArticle()->getId();?></p>
        </div>
        <?php
    }
          
}else{
    echo "Vous n'avez pas de favoris";
}

    
    


?>
