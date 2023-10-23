
<?php
$articles = $result["data"]["articles"];
// $userFavoris = $result["data"]["userFavoris"];


      
foreach($articles as $article){

    if (isset($_SESSION["user"])){
    ?>
        <div class="card-favoris">
        <p ><?=$article->getTitle();?></p>
        </div>
<?php
    } 
    ?>      
     
<?php   
}
?>
