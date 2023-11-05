<?php

$categories = $result["data"]["categories"];

?>


<h1 class="h1-card-category">Liste des Categories</h1>

<div class="cards-category">


<p></p>

<?php
foreach($categories as $category){

    
    ?>
    <div class="card-category">

        <a href="index.php?ctrl=forum&action=detailCategory&id=<?=$category->getId()?>"> 

                <p class="card-category-txt"> <?=$category->getNom(); ?> </p>
                <div class="card-image">
                    <img src="<?=$category->getImage()?>" alt="monImg" class="image-category">
                </div>
        </a> <!-- on recupere le nom depuis entities/category -->
    
        
        
        <?php
        // Vérifiez si un utilisateur est Admin
        if(App\Session::isAdmin()){
                ?>
            <!-- Delete Categories-->
            <a href="index.php?ctrl=forum&action=deleteCategory&id=<?=$category->getId()?>" method="post"> <!-- le form que on a cree dans le forum controller avec le function qui est lie dans le addOrUpdateComment.php  --> 
                <i class="fa-sharp fa-solid fa-circle-minus"></i>
            </a>
            
                <?php
        }
        ?>
            

    </div>

    <?php

   
    
    
}


?>




</div>

<?php
if(App\Session::isAdmin()){
    ?>

    <!--Add Category Form category c'est le plus qui permetre de ajouter un categorie-->
    <a href="index.php?ctrl=forum&action=formCategory" class="add-category">
        <!-- <i class="fa-sharp fa-solid fa-circle-plus fa-lg"  style="color: #54626F;"></i> -->
        <h2>Ajouter Un Categorie</h2>
    </a>

<?php
}
?>