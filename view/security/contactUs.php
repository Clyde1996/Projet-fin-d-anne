

<div id="contactUs">

    <div class="form-contactUs">
        <h1>Contact US</h1>
        <form action="index.php?ctrl=security&action=sendEmail" method="POST" >
                    
            <div class="input-data-contactUs">
                <label for="email">Email :</label>
                <input type="email" name="email" value=""><br>
                <div class="underline"></div>
            </div>

            <div class="input-data-contactUs">
                <label for="subject">Subject :</label>
                <input type="text" name="subject" value=""><br>
                <div class="underline"></div>
            </div>

            <div class="input-data-contactUs">
                <label for="message">Message :</label>
                <textarea name="message" id="" cols="30" rows="10"></textarea><br>
                <div class="underline"></div>
            </div>

            <button type="submit" name="send">Send</button>
        </form>
    </div>
</div>