<?php


$category = $result["data"]["category"];
$articles = $result["data"]["articles"];

?>


<!-- <div class="card-complet-detail-category"> -->
    <h1 class="h1-detailCategory">Saison : <?=$category->getNom()?></h1>

    <div class="detailCategory-cards">
        
    <?php
    foreach($articles as $article){
        ?>
        <div class="detailCategory-card">
            <div class="txt-detailCategory-card">
            <p><?=$article->getTitle()?></p>
            <p><?=$article->getCreationdate()?></p>
            </div>
            <img src="<?=$article->getImage()?>" alt="cover-img">
            
            <a href="index.php?ctrl=forum&action=addToFavoris&id=<?=$article->getId()?>">
            <i class="fa-solid fa-heart fa-xl heart-icon" style="color: #9cabc4;" onmouseover="this.style.color='red'" onmouseout="this.style.color='#1f514b'"></i>
            </a>
        </div>


    
    <?php
    }
    ?>
    </div>
<!-- </div> -->