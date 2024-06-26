<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge"> 
    <?php
    if(isset($description)){
        ?>
        <meta name="description" content="<?= $description?>">
        <?php
    }
    ?>
   

    <script src="https://cdn.tiny.cloud/1/zg3mwraazn1b2ezih16je1tc6z7gwp5yd4pod06ae5uai8pa/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <!-- <script src="https://cdn.tiny.cloud/1/43acdq67xm4lx3vzd4w026z0v7wp95jzo099hsxaw2tdlxfs/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="public/css/style.css">
    <script src="public/js/script.js"></script>
    
    
    <title>Wanderlust</title>
    <link rel="Wanderlust Icon" type="png" href="https://th.bing.com/th/id/R.8d55d8d44b60598434ce9b311147529d?rik=48O6mEeBmklxHw&riu=http%3a%2f%2fvaulten.com%2fimg%2funlimited-possiblities.png&ehk=duWFm7WJBG36sTZyv229%2bhie7qi900YfkdLVakI%2bfqA%3d&risl=&pid=ImgRaw&r=0">

    
</head>
<body>
    <header>
    

    <div id="wrapper"> 

    <a href="http://localhost/klajdi_HAZIRAJ/wanderlust/Projet-fin-d-anne/">
        <img src="./public/img/rrr.png" alt="wanderlust-logo" class="wanderlust-wrapper">
    </a>
        

        <div id="mainpage">
            <!-- c'est ici que les messages (erreur ou succès) s'affichent-->
            <h3 class="message" style="color: red"><?= App\Session::getFlash("error") ?></h3>
            <h3 class="message" style="color: green"><?= App\Session::getFlash("success") ?></h3>


                <nav>
                    <div id="nav-left">
                        <ul> 
                        <li><a href="http://localhost/klajdi_HAZIRAJ/wanderlust/Projet-fin-d-anne/">Accueil</a></li>
                        <?php
                        // Vérifiez si un utilisateur est Admin
                        if(App\Session::isAdmin()){
                             ?>
                            <li><a href="index.php?ctrl=forum&action=listUsers">Liste des Users</a></li> <!---->
                          
                             <?php
                        }
                        ?>
                        </ul>
                    </div>
                        
                    
                    
                    
                    <div id="nav-right">

                        <a id="topnav_hamburger_icon" href="javascript:void(0);">
                        <!-- Some spans to act as a hamburger -->
                            <span></span>
                            <span></span>
                            <span></span>
                        </a>
                        <div role="navigation" id="topnav_responsive_menu"> 
                            <?php
                                // Vérifiez si un utilisateur est connecté
                                if(App\Session::getUser()){
                                ?>  
                                        <ul>
                                            <!-- <li><a href="index.php">Accueil</a></li> -->
                                            <li><a href="index.php?ctrl=security&action=viewProfile">Profil</a></li>
                                            <li><a href="index.php?ctrl=forum&action=listCategories">Liste des Catégories</a></li>
                                            <li><a href="index.php?ctrl=security&action=logout">Déconnexion</a></li>
                                        </ul>
                                    <?php
                                }
                                //  si  l'utilisateur est pas connecté
                                else{
                                    ?>

                                        <ul>
                                            <li><a href="index.php?ctrl=security&action=loginForm">Connexion</a></li>
                                            <li><a href="index.php?ctrl=security&action=registerForm">Inscription</a></li>
                                            <!-- <a href="index.php?ctrl=forum&action=listArticles">List des Articles</a> -->
                                            <li><a href="index.php?ctrl=forum&action=listTypes">List Types</a></li>
                                            <!-- <a href="index.php?ctrl=forum&action=listCategories">la liste des categories</a> -->
                                        </ul>
                                <?php
                                }
                        
                                
                            ?>
                        </div>
                    </div>

                    <div>
                        <ul>

                        </ul>
                    </div>
                </nav>
                <div class="top">
                    <i class="fa-solid fa-arrow-up" alt="scroll to top logo"></i>
                </div>
    </header>
            
            
            <main id="forum">

                <?= $page ?> <!--Le contenu de pages listCategories/ list Articles/ listUsers etc-->
            </main>
        </div>
        <footer>
            <p>&copy; 2023 - Clyde's Forum  - <a href="/home/forumRules.html">Règlement du forum</a> - <a href="">Mentions légales</a></p>
            <p><a href="index.php?ctrl=security&action=cgu">CGU</a></p>
            <p><a href="index.php?ctrl=security&action=contactUs">Contact US</a></p>
            <!--<button id="ajaxbtn">Surprise en Ajax !</button> -> cliqué <span id="nbajax">0</span> fois-->

            
            <div id="section1-social-medias">
                <a class="fa-brands fa-instagram" href="https://www.instagram.com/"></a>
                <a class="fa-brands fa-twitter" href="https://twitter.com/"></a>
                <a class="fa-brands fa-facebook" href="https://fr-fr.facebook.com/"></a>    
            </div> 
                            
        </footer>
    </div>
    <script
        src="https://code.jquery.com/jquery-3.4.1.min.js"
        integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
        crossorigin="anonymous">
    </script>
    <script>

        $(document).ready(function(){
            $(".message").each(function(){
                if($(this).text().length > 0){
                    $(this).slideDown(500, function(){
                        $(this).delay(3000).slideUp(500)
                    })
                }
            })
            $(".delete-btn").on("click", function(){
                return confirm("Etes-vous sûr de vouloir supprimer?")
            })
            tinymce.init({
                selector: '.post',
                menubar: false,
                plugins: [
                    'advlist autolink lists link image charmap print preview anchor',
                    'searchreplace visualblocks code fullscreen',
                    'insertdatetime media table paste code help wordcount'
                ],
                toolbar: 'undo redo | formatselect | ' +
                'bold italic backcolor | alignleft aligncenter ' +
                'alignright alignjustify | bullist numlist outdent indent | ' +
                'removeformat | help',
                content_css: '//www.tiny.cloud/css/codepen.min.css'
            });
        })

        

        /*
        $("#ajaxbtn").on("click", function(){
            $.get(
                "index.php?action=ajax",
                {
                    nb : $("#nbajax").text()
                },
                function(result){
                    $("#nbajax").html(result)
                }
            )
        })*/
    </script>
</body>
</html>