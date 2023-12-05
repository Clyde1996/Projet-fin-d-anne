
<?php 
$comment = $result["data"]["comment"];
?>


<div class="form-update-comment">
    <form action="index.php?ctrl=forum&action=updateComment&id=<?=$comment->getId()?>" method="post"> <!--  le format qui permetre de ajouter un categorie   -->
        <h1>Update Comment</h1>
        <label for="nomGenre">Comment</label>
        <textarea type="text" id="nom" name="text"></textarea>
        
        <button type="submit">modifier</button>

    </form>
</div>