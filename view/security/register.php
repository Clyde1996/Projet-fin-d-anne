<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div class="login-register">

        <h1>S'inscrire</h1>
        <form action="index.php?ctrl=security&action=register" method="POST">
            <div class="input-box">
                <label for="pseudo">Username</label>
                <input type="text" name="username" id="username"></br>
            </div>
            <div class="input-box">
                <label for="email">Email</label>
                <input type="email" name="email" id="email"></br>
            </div>
            <div class="input-box">
                <label for="pass1">Password</label>
                <input type="password" name="pass1" id="pass1"></br>
            </div>
            <div class="input-box">
                <label for="pass2">Confirm Your Password</label>
                <input type="password" name="pass2" id="pass2"></br>
            </div>
            <input type="submit" name="submit" value="Sign up"></br>
        </form>

        <div class="register-login-link">
                <p>Have an account? <a href="index.php?ctrl=security&action=connexionForm">Log in</a></p>

        </div>

    </div>
</body>
</html>