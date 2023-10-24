


<h1 class="h1-detailCategory">Mes Favrois</h1>
<?php



$favoris = $result["data"]["favoris"];
// $userFavoris = $result["data"]["userFavoris"];

?>
<div class="detailCategory-cards">
<?php
if(App\Session::getUser()){


    foreach($favoris as $favori){
        ?>
        <div class="detailCategory-card">
        <p ><?=$favori->getArticle()->getTitle();?></p>
        <p ><?=$favori->getArticle()->getCreationdate();?></p>
        <p ><img src="<?=$favori->getArticle()->getImage();?>" alt="mes-favoris-img"></p>
        
        </div>
        <?php
    }
          
}else{
    echo "Vous n'avez pas de favoris";
}
?>
</div>
    

