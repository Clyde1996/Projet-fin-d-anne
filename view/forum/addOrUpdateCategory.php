<form action="index.php?ctrl=forum&action=addCategory" method="post"> <!--  le format qui permetre de ajouter un categorie   -->

    <label for="nomGenre">Nom de la categorie</label>
    <input type="text" id="nom" name="nom"  />
    <!-- id pour recevoir le focus sur l'input quand on clique sur le label correspondant (label.for == input.id) -->
    <!-- name pour que la value soit envoyée dans le formulaire en POST (sera récupéré dans le contrôleur) -->

    <button type="submit">Enregistrer</button>

    
</form>

