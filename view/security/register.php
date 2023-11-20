<section id="login-register">
    <div class="login-register">

        <h1>S'inscrire</h1>
        <form action="index.php?ctrl=security&action=register" method="POST">
            <div class="input-box">
                <label for="pseudo">Username</label>
                <input type="text" name="username" id="username" placeholder="username"></br>
            </div>
            <div class="input-box">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" placeholder="email"></br>
            </div>
            <div class="input-box">
                <label for="pass1">Password</label>
                <input type="password" name="pass1" id="pass1" placeholder="password"></br>
            </div>
            <div class="input-box">
                <label for="pass2">Confirm Your Password</label>
                <input type="password" name="pass2" id="pass2" placeholder="confirm password"></br>
            </div>
            <div>
                <label for="accept-terms">
                    En cochant cette case, vous acceptez nos conditions générales d'utilisation
                    <a href="index.php?ctrl=security&action=cgu">CGU</a>
                </label>
                <input type="checkbox" name="accept-terms" id="accept-terms" required>
            </div>
            <input type="submit" name="submit" value="Sign up"></br>
        </form>

        <div class="register-login-link">
                <p>Have an account? <a href="index.php?ctrl=security&action=loginForm">Log in</a></p>

        </div>

    </div>
</section>