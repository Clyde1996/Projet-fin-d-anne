<?php

// Récupération des données du résultat
$category = $result["data"]["category"];
$articles = $result["data"]["articles"];

?>


<!-- <div class="card-complet-detail-category"> -->
    <div class="h1-detailCategory">
        <h1 >Saison : <?=$category->getNom()?></h1>
        <a href="index.php?ctrl=forum&action=listCategories" class="a-accueil">
            <i class="fa-solid fa-backward" style="color: #ffffff;"></i>
        </a>
    </div>
    
    <div class="detailCategory-cards">
        
        <?php
        //pour chaque articles as article
        foreach($articles as $article){
            ?>

            <div class="detailCategory-card">

                <a href="index.php?ctrl=forum&action=detailArticle&id=<?=$article->getId()?>"> <!--Redirection vers un autre page-->
                    <div class="txt-detailCategory-card">
                    <p><?=$article->getTitle()?></p>
                    <p><?=$article->getCreationdate()?></p>
                    </div>
                    
                    <?php
                    // Condition pour déterminer le format du chemin d'accès à l'image
                    if ($article->getImage() !== null) {
                        if (strpos($article->getImage(), 'http') === 0) {
                            // Le chemin d'accès à l'image commence par 'http', donc c'est un lien complet
                            echo "<img src=\"{$article->getImage()}\" alt=\"{$article->getTitle()}\">";
                        } else {    
                            // Le chemin d'accès à l'image ne commence pas par 'http', donc c'est un chemin local
                            echo "<img src=\"./public/img/{$article->getImage()}\" alt=\"{$article->getTitle()}\">";
                        }
                    } else {
                        // Le chemin d'accès à l'image est null, affichez une image par défaut ou un espace réservé
                        echo "<img src=\"./public/img/istockphoto-891939670-2048x2048-transformed.jpeg\" alt=\"image-par-défaut\">";
                    }
                    ?>

                </a>

                
                    <!--Si le user est en session il peut mettre les articles en favoris sinon je redirige vers login-->
                <?php if(App\Session::getUser()){ ?>
            
                    <a href="index.php?ctrl=forum&action=addToFavoris&id=<?=$article->getId()?>">
                        <i class="fa-solid fa-heart fa-xl heart-icon" style="color: #9cabc4;" onmouseover="this.style.color='red'" onmouseout="this.style.color='#1f514b'"></i>
                    </a>
        
                <?php } else{
                    echo  "<a href='index.php?ctrl=security&action=loginForm'>". "Ajouter au favoris" ."</a>";
                } ?>
                
                
            </div>


        
        <?php
        }
        ?>
    </div>
<!-- </div> -->

<!-- si le user est en session il peut ajouter un article sinon je redirige vers login-->
<?php if(App\Session::getUser()){ ?>

        <!--Le form pour ajouter un Article-->
        <a href="index.php?ctrl=forum&action=formArticle&id=<?= $category->getId() ?>" class="add-category">
            <!-- <i class="fa-sharp fa-solid fa-circle-plus fa-lg"  style="color: #54626F;"></i> -->
            <h2>Ajouter Un Article</h2>
        </a>

<?php } else{ ?>

        <!--Si le utilisateur est pas connecter on redirige ver le connexion-->
            <a href="index.php?ctrl=security&action=loginForm" class="add-category">

                <h2>Ajouter Un Article</h2>
            </a>

    <?php } ?>


