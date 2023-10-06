<?php


$category = $result["data"]["category"];
$articles = $result["data"]["articles"];

foreach($articles as $article){
    ?>
    
    <p><?=$article->getTitle()?></p>
    <p><?=$article->getCreationdate()?></p>
    
   
   <?php
}