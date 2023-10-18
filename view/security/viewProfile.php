
<?php

$user = $result["data"]["user"];

?>

<div class="profil">

    <h2><i><?= App\Session::getUser()->getUsername()?></i></h2>
    <p><img src="<?= App\Session::getUser()->getImage()?>" alt="profile-image" class="profile-image"></p>
    <p><b><i>Email : </i></b><?= App\Session::getUser()->getEmail()?></p>
    <p><b><i>Date d'inscription : </i></b><?= App\Session::getUser()->getDateInscription()?></p>
    

    <?php
    if (App\Session::getUser()->hasRole("ROLE_USER")) {
    ?>
    <p>Role : User</p>
    <?php
    } else if (App\Session::isAdmin()) {
    ?>
    <p>Role : Administrator</p> 
    <?php
    }

    ?>

    <!--Le form qui permettre de uptade le username-->
<a href="index.php?ctrl=security&action=formUpdateUser"> 
    <p>Update Profile</p>
</a>


</div>