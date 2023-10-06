<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="public/css/style.css">
    <title>Document</title>
</head>
<body>
    
    <div class="login-register">
        <h1>Se connecter</h1>

        <form action="index.php?ctrl=security&action=login" method="post" class="login-register-card">
            
            <div class="input-box">
                <label for="email">Email</label>
                <input type="email" name="email" id="email"></br>
                <i class="fa-regular fa-user icon-user"></i>
            </div>
            <div class="input-box">
                <label for="password">Password</label>
                <input type="password" name="password" id="password"></br>
                <i class="fa-solid fa-lock icon-lock"></i>
            </div>
            <input type="submit" name="submit" value="Log in"></br>
            
            
        </form>
        <div class="register-login-link">
                <p>Don't have an account? <a href="index.php?ctrl=security&action=registerForm">Sign up</a></p>

        </div>
    </div>
</body>
</html>
