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
    if(!empty($articles)){ // si les articles sont pas empty on affiche ca 
        foreach ($articles as $article){
        ?>

            <div class="detailCategory-card">

                <a href="index.php?ctrl=forum&action=detailArticle&id=<?=$article->getId()?>"> <!--Redirection vers un autre page-->
                    <div class="txt-detailCategory-card">
                    <p><?=$article->getTitle()?></p>
                    <p><?=$article->getCreationdate()?></p>
                    <p><?=$article->getId()?></p>
                    </div>
                    
                    <?php
                    // Condition pour déterminer le format du chemin d'accès à l'image
                    if ($article->getImage() !== null) {
                        if (strpos($article->getImage(), 'http') === 0) {
                            // Le chemin d'accès à l'image commence par 'http', donc c'est un lien complet
                            echo "<img src=\"{$article->getImage()}\" alt=\"Images de {$article->getContent()}\">";
                        } else {
                            // Le chemin d'accès à l'image ne commence pas par 'http', donc c'est un chemin local
                            echo "<img src=\"./public/img/{$article->getImage()}\" alt=\"Images de {$article->getContent()}\">";
                        }
                    } else {
                        // Le chemin d'accès à l'image est null, affichez une image par défaut ou un espace réservé
                        echo "<img src=\"./public/img/istockphoto-891939670-2048x2048-transformed.jpeg\" alt=\"cover-img\">";
                    }
                    ?>
        
                </a>


                <!--Si le user est en session il peut mettre les articles en favoris sinon je redirige vers login-->
                <?php if(App\Session::getUser()){ ?>

                    <a href="index.php?ctrl=forum&action=addToFavoris&id=<?=$article->getId()?>">
                        Ajouter au favoris
                    </a>

                <?php } else{
                    echo  "<a href='index.php?ctrl=security&action=loginForm'>". "Ajouter au favoris" ."</a>";
                } ?>


            </div>

        <?php
        }
    }else{
        echo "Il n'y a aucun article qui appartient à ce type.";
    }
    ?>
    
</div>

               