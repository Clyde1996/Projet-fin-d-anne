
<?php 
$comment = $result["data"]["comment"];
?>

<form action="index.php?ctrl=forum&action=updateComment&id=<?=$comment->getId()?>" method="post"> <!--  le format qui permetre de ajouter un categorie   -->
 
    <label for="nomGenre">Comment</label>
        <textarea type="text" id="nom" name="text">

            </textarea>
    <button type="submit">modifier</button>

            <!-- id pour recevoir le focus sur l'input quand on clique sur le label correspondant (label.for == input.id) -->
        <!-- name pour que la value soit envoyée dans le formulaire en POST (sera récupéré dans le contrôleur) -->

    
</form>
