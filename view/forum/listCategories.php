<?php

$categories = $result["data"]["categories"];

?>

<h1>Liste des Categories</h1>
<div class="cards-category">


<p></p>

<?php
foreach($categories as $category){

    
    ?>
    <div class="card-category">

        <a href="index.php?ctrl=forum&action=detailCategory&id=<?=$category->getId()?>"> <?=$category->getNom(); ?> 
                <div class="card-image">
                    <img src="<?=$category->getImage()?>" alt="monImg" class="image-category">
                </div>
        </a> <!-- on recupere le nom depuis entities/category -->
    
        
        <!-- Delete Categories-->
            <a href="index.php?ctrl=forum&action=deleteCategory&id=<?=$category->getId()?>" method="post"> <!-- le form que on a cree dans le forum controller avec le function qui est lie dans le addOrUpdateComment.php  --> 
                <i class="fa-sharp fa-solid fa-circle-minus"></i>
            </a>
        

    </div>

    <?php

   
    
    
}


?>
<?php

if (isset($_SESSION["user"]) && $_SESSION["user"]->getRole() == "ROLE_ADMIN"){
    ?>
    
 <!--Add Category Form category c'est le plus qui permetre de ajouter un categorie-->
 <a href="index.php?ctrl=forum&action=formCategory">
    <i class="fa-sharp fa-solid fa-circle-plus fa-lg" style="color: #54626F;"></i>
</a>
    <?php
}
?>



</div>