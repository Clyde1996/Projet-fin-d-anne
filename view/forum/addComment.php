<?php


?>

<form action="index.php?ctrl=forum&action=addComment&id=<?=$_GET['id']?>" method="post"> <!--  le format qui permetre de ajouter un categorie   -->

    <label for="nomGenre">Comment</label>
    <input type="text" id="nom" name="text"  />
    <!-- id pour recevoir le focus sur l'input quand on clique sur le label correspondant (label.for == input.id) -->
    <!-- name pour que la value soit envoyée dans le formulaire en POST (sera récupéré dans le contrôleur) -->

    <button type="submit">ajouter</button>

    
</form>






