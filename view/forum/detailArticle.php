
<?php

$article = $result["data"]["article"];
$comments = $result["data"]["comments"];
$images = $result["data"]["images"];
$user = $result["data"]["user"];
$types = $result["data"]["types"];

?>
 



<div class="card">

     <!-- Contenu de detail article-->

     <!-- Pictogram --> 

    <div class="pictos">
        
        <?php if (!empty($types)): ?>
        <?php foreach($types as $type): ?>
            <a href="index.php?ctrl=forum&action=detailType&id=<?=$type->getId()?>">
                <img class="picto" src="./public/img/<?=$type->getPictogram();?>" alt="<?= $type->getName()?>">
                <p><?= $type->getName()?></p>
                
            </a> 
        <?php endforeach; ?>
        <?php else: ?>
            <p>Aucun type disponible.</p>
        <?php endif; ?>
        
    </div>

    <div class="detailArticle-contenu">
        <!--Title De article-->
        <h1> <?=$article->getTitle();?> </h1>  

        <p class="detail-article-p">Créé par : <?=$article->getUser()->getUsername();?></p>
        <p class="detail-article-p">Date de Creation : <?=$article->getCreationdate()?></p>
        
    </div>
    
    <!--Les images et les fleches qui permettre de change les images-->
    <div class="image-container">

        <!-- On select les images -->
        <?php 
        if (empty($images)) {
            echo "<p>Il n'y a pas d'images.</p>";
        } else {
            foreach($images as $image): 
                
                        // Condition pour déterminer le format du chemin d'accès à l'image
                        if ($image->getURL() !== null) {
                            if (strpos($image->getURL(), 'http') === 0) {
                                // Le chemin d'accès à l'image commence par 'http', donc c'est un lien complet
                                echo "<img src=\"{$image->getURL()}\" alt=\"cover-img\">";
                            } else {
                                // Le chemin d'accès à l'image ne commence pas par 'http', donc c'est un chemin local
                                echo "<img src=\"./public/img/{$image->getURL()}\" alt=\"cover-img\">";
                            }
                        } else {
                            // Le chemin d'accès à l'image est null, affichez une image par défaut ou un espace réservé
                            echo "<img src=\"./public/img/istockphoto-891939670-2048x2048-transformed.jpeg\" alt=\"cover-img\">";
                        }
            
            endforeach; 
        }
         ?> <!--On arrete le execution-->

       
        
        <!-- Flèche gauche -->
        <div class="prev-arrow"> 
            <i class="fa-solid fa-arrow-left"  style="color: #ffffff;"></i>
        </div> 
        <!-- Flèche droite -->
        <div class="next-arrow"> 
            <i class="fa-solid fa-arrow-right" style="color: #ffffff;"></i>
        </div> 
        

    </div>

     <!-- Contenu Article -->
    <div class="detailArticle-contenu">
        <h2 class="h2-detail-article-contenu">Contenu :</h2>
        <p class="detail-article-p"><?=$article->getContent();?></p>
    </div>

    <!-- Vérifiez que $comments n'est pas null-->
    <?php if ($comments !== null){ ?>  

<?php foreach($comments as $comment){ ?>
    
    <div class="detailArticle-contenu">
        
        <p><?=$comment->getUser()->getUsername()?></p>
        <!--on affiche l'image de user dans le commentaire, si il a pas un on affiche le message par defaut-->
        <?php $userImage = App\Session::getUser()->getImage(); ?>

        <?php if(empty($userImage)) { ?>
            <img src="./public/img/149071.png"  alt="profile-image">
        <?php } else { ?>
            <img src="./public/img/<?= $userImage ?>" >
        <?php } ?>

        <p> <?=$comment->getCreationdate();?> </p>
        <p> <?=$comment->getText();?> </p>
        
        <!-- Si le user est connecté -->
        <div class="icones-detail-article">
            <?php if(App\Session::getUser()) { ?>
                <!-- Si le user est administrateur OU le créateur du commentaire, on affiche les options de suppression et de modification -->
                <?php if(App\Session::isAdmin() || App\Session::getUser()->getId() === $comment->getUser()->getId()) { ?>
                    <!-- Le formulaire de suppression du commentaire -->
                    <a href="index.php?ctrl=forum&action=deleteComment&id=<?=$comment->getId()?>" class="delete-detail-article">
                        <i class="fa-sharp fa-solid fa-circle-minus"></i>
                    </a> 

                    <!-- Le formulaire de modification du commentaire -->
                    <a href="index.php?ctrl=forum&action=updateFormComment&id=<?=$comment->getId()?>" class="modifier-detail-article">
                        <i class="fas fa-edit" style="color: #ffffff;"></i>
                    </a> 
                <?php } ?>
            <?php } ?>
        </div>
    </div>
<?php }                              
} else {
echo "<p>Aucun commentaire disponible.</p>";
} ?>

    <!-- index.php -> nom de fichier ::  ? -> indique le début des paramètres de l'URL :: ctrl=forum ->  C'est un paramètre nommé "ctrl" qui a la valeur "forum". ::  & -> L'esperluette est utilisée pour séparer plusieurs paramètres de l'URL. Ici, il sépare le premier paramètre "ctrl" du paramètre suivant. ::   action=formPost: C'est un autre paramètre nommé "action" avec la valeur "formPost" :: & sépare ce paramètre du suivant
    id=< ?=$article->getId()?> Ce paramètre nommé "id" a une valeur dynamique qui provient d'une variable PHP $article->getId(). Il peut s'agir d'un identifiant unique d'un sujet de forum (par exemple) qui sera utilisé par le contrôleur pour effectuer une action spécifique concernant ce sujet. -->

   <!--Si le user est connecte il peu commente else il devrait etre connecte-->
    <?php if(App\Session::getUser()){ ?>
        
        <div class="input-data">
            <form method="post" action="?ctrl=forum&action=addComment&id=<?= $article->getId() ?>">
                <textarea name="comment" placeholder="Ajouter un commentaire"></textarea>
                <input type="submit" value="Publier">
            </form>
        </div>

    <?php } else{
        echo  "<a href='index.php?ctrl=security&action=loginForm'>". "Ajouter un commentaire" ."</a>";
    } ?>



</div>
