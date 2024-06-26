<?php
$articles = $result["data"]["articles"];
$type = $result["data"]["type"];

?>
<div class="h1-detailCategory">
    <h1 >Type : <?=$type->getName()?></h1>
    
   
    <a href="index.php?ctrl=forum&action=listTypes" class="a-accueil">
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
                        echo "<img src=\"./public/img/istockphoto-891939670-2048x2048-transformed.jpeg\" alt=\"image par défaut\">";
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

               