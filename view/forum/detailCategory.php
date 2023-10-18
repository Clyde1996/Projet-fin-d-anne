<?php


$category = $result["data"]["category"];
$articles = $result["data"]["articles"];

?>

<div class="detailCategory-cards">
<?php
foreach($articles as $article){
    ?>
    <div class="detailCategory-card">
        <p><?=$article->getTitle()?></p>
        <p><?=$article->getCreationdate()?></p>
        <p><img src="<?=$article->getImage()?>" alt="cover-img"></p>
    </div>
   
   <?php
}
?>
</div>