
<?php

$article = $result["data"]["article"];
$comments = $result["data"]["comments"];
?>


<div class="card">
<h1> <?=$article->getTitle();?> </h1>  <!--Title De article-->

<?php
foreach($comments as $comment){
    ?>

    
    <p> <?=$comment->getText();?> </p>
    <p> <?=$comment->getCreationdate();?> </p>

    <!-- le form delete article -->

    <a href="index.php?ctrl=forum&action=deleteComment&id=<?=$comment->getId()?>">
    <i class="fa-sharp fa-solid fa-circle-minus"></i>
    </a> 


    <!-- le form update article -->
    <a href="index.php?ctrl=forum&action=updateFormComment&id=<?=$comment->getId()?>">
    <i class="fa-regular fa-pen-to-square"></i>
    </a> 

    
 
    
    <?php

    

    
}
?>
<!-- index.php -> nom de fichier ::  ? -> indique le début des paramètres de l'URL :: ctrl=forum ->  C'est un paramètre nommé "ctrl" qui a la valeur "forum". ::  & -> L'esperluette est utilisée pour séparer plusieurs paramètres de l'URL. Ici, il sépare le premier paramètre "ctrl" du paramètre suivant. ::   action=formPost: C'est un autre paramètre nommé "action" avec la valeur "formPost" :: & sépare ce paramètre du suivant
id=< ?=$article->getId()?> Ce paramètre nommé "id" a une valeur dynamique qui provient d'une variable PHP $article->getId(). Il peut s'agir d'un identifiant unique d'un sujet de forum (par exemple) qui sera utilisé par le contrôleur pour effectuer une action spécifique concernant ce sujet. -->


 <!-- le form add article-->
<a href="index.php?ctrl=forum&action=formComment&id=<?=$article->getId()?>"> <!--Form Post c'est le "plus +" qui permetre de ajouter un Comment et le function  --> 
    <i class="fa-sharp fa-solid fa-circle-plus fa-lg" style="color: #54626F;"></i>
    
</a>

<a href="?ctrl=forum&action=formComment&id=<?= $article->getId() ?>">Ajouter un commentaire</a>
<form method="post" action="?ctrl=forum&action=addComment&id=<?= $article->getId() ?>">
    <textarea name="text" placeholder="Votre commentaire"></textarea>
    <input type="submit" value="Publier">
</form>

</div>
