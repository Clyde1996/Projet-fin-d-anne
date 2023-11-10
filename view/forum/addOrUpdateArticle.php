<?php
$category = $result["data"]['category'];
// $user = $result["data"]['user'];



?>




<h1>Create new Topic</h1>


<div class="card">
    <form action="index.php?ctrl=forum&action=addArticle&id=<?= $category->getId() ?>" method="POST" enctype="multipart/form-data">

        <label for="title">Title :</label>
        <input type="text" name="title" id="title">

        <label for="content">Content :</label>
        <textarea name="content" cols="30" rows="10"></textarea>

        <label for="coverImage">coverImage :</label>
        <input type="file" name="coverImage" id="coverImage">

        <input type="submit" value="Ajouter">

    </form>
</div>
