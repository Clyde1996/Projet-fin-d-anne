
<?php 
$comment = $result["data"]["comment"];
?>

<form action="index.php?ctrl=forum&action=updateComment&id=<?=$comment->getId()?>" method="post"> <!--  le format qui permetre de ajouter un categorie   -->
 
    <label for="nomGenre">Comment</label>
    <textarea type="text" id="nom" name="text"></textarea>
    
    <button type="submit">modifier</button>

</form>
