<section id="login-register">
    
    <div class="login-register">
        <h1>Se connecter</h1>

        <form action="index.php?ctrl=security&action=login" method="post" class="login-register-card">
            
            <div class="input-box">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" placeholder="email"></br>
                <i class="fa-regular fa-user icon-user"></i>
            </div>
            <div class="input-box">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" placeholder="password"></br>
                <i class="fa-solid fa-lock icon-lock"></i>
            </div>
            <input type="submit" name="submit" value="Log in"></br>
            
            
        </form>
        
        <div class="register-login-link">
                <p>Don't have an account? <a href="index.php?ctrl=security&action=registerForm"> Sign up</a></p>
                <p><a href="index.php?ctrl=security&action=resetPassword">Mot de passe oublié ?</a></p>

        </div>

    </div>

        
    <form action="index.php?ctrl=security&action=sendEmail" method="POST">

        Email : <input type="email" name="email" value=""><br>
        Subject : <input type="text" name="subject" value=""><br>
        Message : <input type="text" name="message" value=""><br>
        <button type="submit" name="send">Send</button>
    </form>
        

</section>

