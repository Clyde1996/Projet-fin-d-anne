<?php


$article = $result["data"]["article"];
$userFavoris = $result["data"]["userFavoris"];


foreach($userFavoris as $favoris){
    ?>

    <?=$favoris->getArticle()->getTitle()?>

    <?php
}

?>

