
<div class="card-update">

    <h1>Update Profile</h1>
<form action="index.php?ctrl=security&action=updateProfile&id=<?=App\Session::getUser()->getId()?>" method="post">
    
<label for="username" >Username:</label>
    <input type="text" name="username" value="<?=App\Session::getUser()->getUsername()?>">

    <label for="email">Email:</label>
    <input type="text" name="email" value="<?=App\Session::getUser()->getEmail()?>">

    <label for="newPassword">New Password:</label>
    <input type="password" name="newPassword">

    <label for="confirmPassword">Confirm New Password:</label>
    <input type="password" name="confirmPassword">
    
    <input type="submit" value="Valider">

</form>
</div>