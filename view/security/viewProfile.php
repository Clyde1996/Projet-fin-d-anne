
<?php

$user = $result["data"]["user"];

?>

<div class="profil">

    <h2><i><?= App\Session::getUser()->getUsername()?></i></h2>
    <div class="profile-image-container">
        
        <?php if(App\Session::getUser()){ ?>

            <p><img src="./public/img/<?= App\Session::getUser()->getImage()?>" alt="profile-image" class="profile-image"></p>

            
        <?php }else{?>

            <p><img src="./public/img/rrr.png" alt="profile-image" class="profile-image"></p>

        <?php } ?>
            
    </div>
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
 <p> <i class="fa-sharp fa-solid fa-gear" style="color: #417ce1;"></i> Update Profile</p> 
</a>

<a href="index.php?ctrl=forum&action=listFavoris&id=<?=App\Session::getUser()->getId()?>">
    <p><i class="fa-solid fa-bookmark" style="color: #6593e2;"></i> Mes Favoris</p>
</a>


<form action="index.php?ctrl=security&action=updateProfileImage&id=<?=App\Session::getUser()->getId()?>" method="post" enctype="multipart/form-data">
                        <label>Change Profile Image: </label><br/>
                        <input type="file" id="avatar" name="photo">
                        <input id="submit" type="submit" name="submit" value="Confirm">
</form>

</div>

