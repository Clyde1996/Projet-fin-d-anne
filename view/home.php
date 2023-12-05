<?php 

$categories = $result["data"]["categories"];
$articles = $result["data"]["articles"];
$description = $result["data"]["descrption"];

?>

    
<div class="home-categories-cards">
    <?php foreach($categories as $category){?>
        <div class="home-categories-card">

            <a href="index.php?ctrl=forum&action=detailCategory&id=<?=$category->getId()?>"> 
                <p><?=$category->getNom();?></p>  
            </a> <!-- on recupere le nom depuis entities/category -->
        
        </div>
        
    <?php } ?>
 
</div>


<section id="accueil">
    <div class="accueil-card">
        <img src="./public/img/rrr.png" alt="wanderlust-logo" class="wanderlust">
        <video class="accueil-video"  muted loop autoplay src="https://video.wixstatic.com/video/375882_9f1a8e8b364946f38b7eb05436e76503/1080p/mp4/file.mp4"></video>
        <div class="hero">
            <a href="index.php?ctrl=forum&action=listCategories" class="a-accueil">
                <p>Explorez le forum et découvrez différentes images qui vous donnent envie de voyager</p>
            </a>
        </div>
    </div>
</section>

<section id="accueil-body">
    


    <div class="accueil-body-p">

        <h3>Bienvenue sur Wanderlust !</h3>

        <p>Bienvenue sur notre portail dédié à <strong>l'aventure et à l'exploration du monde !</strong> Plongez dans nos articles inspirants et informatifs qui vous transporteront vers des <strong>destinations exotiques et des expériences inoubliables.</strong> Nos contributeurs passionnés partagent leurs découvertes des coins les plus reculés de la planète, vous offrant des histoires fascinantes, des conseils pratiques et des récits authentiques. Rejoignez notre communauté Wanderlust pour partager vos propres expériences et conseils, car nous croyons que le partage est essentiel pour créer une communauté de <strong>voyageurs passionnés.</strong></p>

       

        <p>Découvrez nos derniers articles sur les destinations tendance, les pratiques de voyage responsables, les astuces pour économiser et bien plus encore. Que vous soyez un voyageur chevronné à la recherche de nouvelles aventures ou un novice en quête d'inspiration pour votre prochain périple, nos articles sont conçus pour répondre à toutes vos attentes. Rejoignez-nous pour explorer le monde ensemble !</p>

    </div>
    
    
    <div class="detailArticle-accueil-cards">
        <!-- Contenu de la section -->
        <h2 class="exclude-h2"> Les Derniers Articles </h2>

        <?php
        $count = 0; // Initialiser la variable de comptage
        foreach($articles as $article) {
            if ($count < 12) { // Limiter l'affichage à 5 articles
        ?>
                <div class="detailArticle-accueil">
                    <a href="index.php?ctrl=forum&action=detailArticle&id=<?=$article->getId()?>" class="a-detailArticle-accueil">
                        <p><?=$article->getTitle()?></p>
                        <p><?=$article->getCreationdate()?></p>
                        
                        <img src="<?=$article->getImage()?>" alt="<?=$article->getContent()?>">
                    </a>    
                </div>
        <?php
                $count++; // Incrémenter la variable de comptage
            }
        }
        ?>
    </div>
    
</section>