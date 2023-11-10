
<?php

$article = $result["data"]["article"];
$comments = $result["data"]["comments"];
$images = $result["data"]["images"];
$user = $result["data"]["user"];

?>
 



<div class="card">

     <!-- Contenu de detail article-->
    <div class="detailArticle-contenu">
    <!--Title De article-->
    <h1> <?=$article->getTitle();?> </h1>  

    <p class="detail-article-p">Créé par : <?=$article->getUser()->getUsername();?></p>
    <p class="detail-article-p">Date de Creation : <?=$article->getCreationdate()?></p>
    
    </div>
    
    <!--Les images et les fleches qui permettre de change les images-->
    <div class="image-container">

        <!-- On select les images -->
        <?php foreach($images as $image): ?>
                <img src="<?=$image->getURL();?>" alt="Image">
        <?php endforeach; ?> <!--On arrete le execution-->
        
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
    <?php if ($comments !== null){?>  
         
        <?php foreach($comments as $comment){ ?>
            
            <div class="detailArticle-contenu">
            
                <p><?=$comment->getUser()->getUsername()?></p>
                <img src="<?=$comment->getUser()->getImage()?>" alt="">
                <p> <?=$comment->getCreationdate();?> </p>
                <p> <?=$comment->getText();?> </p>
                
            
            

                <!-- Si le user est connecter -->
                <div class="icones-detail-article">
                    <?php if(App\Session::getUser()){ ?>
                        <!-- le form delete article -->
                        <a href="index.php?ctrl=forum&action=deleteComment&id=<?=$comment->getId()?>" class="delete-detail-article">
                        <i class="fa-sharp fa-solid fa-circle-minus"></i>
                        </a> 


                        <!-- le form update article -->
                        <a href="index.php?ctrl=forum&action=updateFormComment&id=<?=$comment->getId()?>" class="modifier-detail-article">
                        <i class="fas fa-edit" style="color: #ffffff;"></i>
                        </a> 
            <?php   } ?>
                </div>
            </div>
<?php   }                              
    }else{
        echo "<p>Aucun commentaire disponible.<p>";
   }?>

    <!-- index.php -> nom de fichier ::  ? -> indique le début des paramètres de l'URL :: ctrl=forum ->  C'est un paramètre nommé "ctrl" qui a la valeur "forum". ::  & -> L'esperluette est utilisée pour séparer plusieurs paramètres de l'URL. Ici, il sépare le premier paramètre "ctrl" du paramètre suivant. ::   action=formPost: C'est un autre paramètre nommé "action" avec la valeur "formPost" :: & sépare ce paramètre du suivant
    id=< ?=$article->getId()?> Ce paramètre nommé "id" a une valeur dynamique qui provient d'une variable PHP $article->getId(). Il peut s'agir d'un identifiant unique d'un sujet de forum (par exemple) qui sera utilisé par le contrôleur pour effectuer une action spécifique concernant ce sujet. -->

   <!--Si le user est connecte il peu commente else il devrait etre connecte-->
    <?php if(App\Session::getUser()){ ?>
        
        <div class="input-data">
            <a href="?ctrl=forum&action=formComment&id=<?= $article->getId() ?>">Ajouter un commentaire</a>
            <form method="post" action="?ctrl=forum&action=addComment&id=<?= $article->getId() ?>">
                <textarea name="text" placeholder="Votre commentaire"></textarea>
                <input type="submit" value="Publier">
            </form>
        </div>

    <?php } else{
        echo  "<a href='index.php?ctrl=security&action=loginForm'>". "Ajouter un commentaire" ."</a>";
    } ?>



</div>
