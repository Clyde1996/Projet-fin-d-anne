<?php


$category = $result["data"]["category"];
$articles = $result["data"]["articles"];

?>


<!-- <div class="card-complet-detail-category"> -->
    <div class="h1-detailCategory">
        <h1 >Saison : <?=$category->getNom()?></h1>
        <a href="index.php?ctrl=forum&action=listCategories" class="a-accueil">
            <i class="fa-solid fa-backward" style="color: #ffffff;"></i>
        </a>
    </div>
    
    <div class="detailCategory-cards">
        
    <?php
    foreach($articles as $article){
        ?>
        <div class="detailCategory-card">
            <a href="index.php?ctrl=forum&action=detailArticle&id=<?=$article->getId()?>"> <!--Redirection vers un autre page-->
            <div class="txt-detailCategory-card">
            <p><?=$article->getTitle()?></p>
            <p><?=$article->getCreationdate()?></p>
            </div>
            <img src="<?=$article->getImage()?>" alt="cover-img">
            </a>

            
            <a href="index.php?ctrl=forum&action=addToFavoris&id=<?=$article->getId()?>">
            <i class="fa-solid fa-heart fa-xl heart-icon" style="color: #9cabc4;" onmouseover="this.style.color='red'" onmouseout="this.style.color='#1f514b'"></i>
            </a>
        </div>


    
    <?php
    }
    ?>
    </div>
<!-- </div> -->



<!--Add Article Form  ca permetre de ajouter un article-->
<a href="index.php?ctrl=forum&action=formArticle" class="add-category">
        <!-- <i class="fa-sharp fa-solid fa-circle-plus fa-lg"  style="color: #54626F;"></i> -->
        <h2>Ajouter Un Article</h2>
</a>