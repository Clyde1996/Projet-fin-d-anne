<?php


?>

<form method="post" action="?ctrl=forum&action=addComment&id=<?= $article->getId() ?>">
    <textarea name="text" placeholder="Votre commentaire"></textarea>
    <input type="submit" value="Publier">
</form>






