<?php


    $favoris = $result["data"]["favoris"];
    // $userFavoris = $result["data"]["userFavoris"];



?>
<h1 class="h1-detailCategory">Mes Favoris</h1>

<div class="detailCategory-cards">
    <?php
        if(App\Session::getUser()){ // si le user est connecte  
            if(!empty($favoris)){ // si l'utilisateur a des favoris

            


                foreach($favoris as $favori){
                    ?>
                    
                    <div class="detailCategory-card">
                    <a href="index.php?ctrl=forum&action=deleteFromFavoris&id=<?=$favori->getArticle()->getId()?>">
                        <i class="fa-regular fa-bookmark" style="color: #9cabc4;" onmouseover="this.style.color='red'" onmouseout="this.style.color='#1f514b'"></i>
                    </a>
                    <a href="index.php?ctrl=forum&action=detailArticle&id=<?=$favori->getArticle()->getId()?>">
                        <p ><?=$favori->getArticle()->getTitle();?></p>
                        <p ><?=$favori->getArticle()->getCreationdate();?></p>
                        <p ><img src="<?=$favori->getArticle()->getImage();?>" alt="Images Dans Mes Favoris : <?=$favori->getArticle()->getTitle();?>"></p>
                    </a>
                    </div>
                    <?php
                }
            }else{
                echo "Vous n'avez pas de favoris"; // si l'utilisiteur n'as pas des favoris ca s'affiche l'e message d'erreur 
            }  
        }
    ?>
</div>
    

