<?php

$users = $result["data"]["users"];

?>

<div class="card">
<h1>Liste de Users</h1>

<?php

foreach($users as $user){
    ?>
  
  
   
  <?php


  if ($user->hasRole("ROLE_USER")) {
    echo "<p> Date De Inscription D'utilisateur : ".$user->getDateInscription() ." </br> User  : ". $user->getUsername() .  "  </br> </p>";
  } 
  // else{
  //   echo $user->getUsername(). " ADMIN </br>";
  // }
} 

?>
</div>