
<?php

$user = $result["data"]["user"];

?>


<h2><i><?= App\Session::getUser()->getUsername() ?></i></h2>

<p><b><i>Email : </i></b><?= App\Session::getUser()->getEmail() ?></p>
<p><b><i>Date  D'inscription : </i></b><?= App\Session::getUser()->getDateInscription() ?></p>

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

