<?php

$articles = $result["data"]['articles'];
$category = $result["data"]['category'];
    
?>
<div class="card">

    <div class="h1-detailCategory">
        <h1>Liste des articles</h1>
        <a href="index.php?ctrl=forum&action=listCategories" class="a-accueil">
            <i class="fa-solid fa-backward" style="color: #ffffff;"></i>
        </a>
    </div>

    <?php
    foreach($articles as $article ){

        ?>
        <a href="index.php?ctrl=forum&action=detailarticle&id=<?=$article->getId()?>"><p><?=$article->getTitle()?></p></a> <!-- on recupere Title depuis entities/article -->
        <p><?=$article->getCreationdate()?></p>
        <p>Catégorie : <?=$article->getCategory()->getNom()?></p>
        <p>Auteur : <?=$article->getUser()->getUsername()?></p>

        <!--on peut supprimer les articles par id-->
        <a href="index.php?ctrl=forum&action=deletearticle&id=<?=$article->getId()?>" method="post"> <!-- le form que on a cree dans le forum controller avec le function qui est lie dans le addOrUpdateComment.php  --> 
        <i class="fa-sharp fa-solid fa-circle-minus"></i>
        </a>

        <?php
    }
    ?>

    <!--Form article c'est le plus qui permetre de ajouter un categorie-->
    <a href="index.php?ctrl=forum&action=formArticle"> 
        <i class="fa-sharp fa-solid fa-circle-plus"></i>
    </a>

</div>
  
