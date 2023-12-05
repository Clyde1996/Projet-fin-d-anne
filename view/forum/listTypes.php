<?php
$types = $result["data"]["types"];

?>
<h1 class="h1-card-category">Types</h1>
<div class="cards-category">
    <?php
        foreach ($types as $type) {
            ?>
            <div class="card-category">

                <a href="index.php?ctrl=forum&action=detailType&id=<?=$type->getId()?>">
                    <p class="card-category-txt"> <?=$type->getName(); ?> </p>
                    <div class="card-image">
                        <img src="./public/img/<?=$type->getPictogram()?>" alt="Voyage <?=$type->getName(); ?>" class="image-category">
                    </div>
                </a>
            </div>
            <?php
        }

    ?> 
</div>

<
               