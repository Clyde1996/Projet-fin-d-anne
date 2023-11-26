<?php

$users = $result["data"]["users"];

?>

<div class="cards-list-users">

  <h1>Liste des Users</h1>




  <?php

    foreach($users as $user){
    ?>
      
      <?php if ($user->hasRole("ROLE_USER")) { ?>

        <?php $userImage = $user->getImage(); ?>

        
        <div class="card-list-users">

          <p><?=$user->getId()?></p>

          <?php if(empty($userImage)){ ?>
            <img src="./public/img/profile.png" class="list-users-img">
          <?php }else{ ?>
            <img src="<?= $userImage ?>"  class="list-users-img">
         <?php } ?>

          
          <p> Date De Inscription D'utilisateur : <br><?= $user->getDateInscription()?></br> </p> 
          <p> <?= $user->getUsername()?> </p>
  <?php
          if($user->getIsBan() == 0 ){
  ?>
            <a href="index.php?ctrl=security&action=banOrUnban&id=<?= $user->getId() ?>">
              <button class="ban-button">bannir</button>
            </a>

  <?php
          }else{
  ?>
            <a href="index.php?ctrl=security&action=banOrUnban&id=<?= $user->getId() ?>">
              <button class="unban-button">unban</button>
            </a>
  <?php
          }
  ?> 

        </div>
      
        <?php
      }

    } 
  ?>
 

</div>