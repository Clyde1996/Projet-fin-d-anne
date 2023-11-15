<?php
$category = $result["data"]['category'];
$types = $result["data"]["types"];
// $user = $result["data"]['user'];



?>







<div class="addArticle-card">
    <h1>Add Article</h1>
    <form action="index.php?ctrl=forum&action=addArticle&id=<?= $category->getId() ?>" method="POST" enctype="multipart/form-data">

        <label for="title">Title :</label>
        <input type="text" name="title" id="title">

        <label for="content">Content :</label>
        <textarea name="content" cols="30" rows="10"></textarea>

        <label for="coverImage">coverImage :</label>
        <input type="file" name="coverImage" id="coverImage">

        <label for="images">Images:</label>
        <input type="file" name="images[]" id="images" multiple accept="image/*">
        
        <!-- on recupere les names de types on list de select-->
        <div class="addArticle-card-checkbox">
            <?php foreach($types as $type): ?>
                <label>
                    <input type="checkbox" name="types[]" value="<?= $type->getId() ?>">
                    <?= $type->getName() ?>
                </label>
            <?php endforeach; ?>
        </div>

        <input type="submit" value="Ajouter">


    </form>
</div>
