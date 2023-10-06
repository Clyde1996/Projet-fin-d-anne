<?php

$categories = $result["data"]["categories"];

?>
<div class="card">
<h1>Liste des Categories</h1>

<?php
foreach($categories as $category){
    ?>

   <a href="index.php?ctrl=forum&action=detailCategory&id=<?=$category->getId()?>"><?=$category->getNom(); ?></a> <!-- on recupere le nom depuis entities/category -->
 
    

   <!-- Delete Categories-->
    <a href="index.php?ctrl=forum&action=deleteCategory&id=<?=$category->getId()?>" method="post"> <!-- le form que on a cree dans le forum controller avec le function qui est lie dans le addOrUpdateComment.php  --> 
    <i class="fa-sharp fa-solid fa-circle-minus"></i>
    </a>




    <?php
    
    
}


?>

 <!--Add Category Form category c'est le plus qui permetre de ajouter un categorie-->
<a href="index.php?ctrl=forum&action=formCategory">
    <i class="fa-sharp fa-solid fa-circle-plus"></i>
</a>

</div>