<?php 

$categories = $result["data"]["categories"];

?>

    
<div class="home-categories">
    <?php foreach($categories as $category){?>


        

        <p><?=$category->getNom();?></p>


    <?php } ?>
 
</div>


<section id="accueil">
    <div class="accueil-card">
        <img src="./public/img/rrr.png" alt="wanderlust" class="wanderlust">
        <video class="accueil-video"  muted loop autoplay src="https://video.wixstatic.com/video/375882_9f1a8e8b364946f38b7eb05436e76503/1080p/mp4/file.mp4"></video>
        <div class="hero">
            <a href="index.php?ctrl=forum&action=listCategories" class="a-accueil">
                <p>Explorez le forum et découvrez différentes images qui vous donnent envie de voyager . </p>
            </a>
        </div>
    </div>
</section>

<section id="accueil-body">
    <div>
        <!-- Contenu de la section -->
    </div>
    <h2>
        Les Derniers Articles
    </h2>
</section>