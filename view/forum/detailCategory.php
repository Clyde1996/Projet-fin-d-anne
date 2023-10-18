<?php


$category = $result["data"]["category"];
$articles = $result["data"]["articles"];

foreach($articles as $article){
    ?>
    <div class="card">
    <p><?=$article->getTitle()?></p>
    <p><?=$article->getCreationdate()?></p>
    <p><img src="<?=$article->getImage()?>" alt="cover-img"></p>
    </div>
   
   <?php
}