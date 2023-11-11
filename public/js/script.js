
// let menu = document.getElementById("topnav_responsive_menu");
// let icon = document.getElementById("topnav_hamburger_icon");

// function openBurgerMenu() {
//     menu.className = "open";
//     icon.className = "open";
//     // root.style.overflowY = "hidden";
// }

// function closeBurgerMenu() {
//     menu.className = "";                    
//     icon.className = "";
//     // root.style.overflowY = "";
// }

// // opens or closes the menu
// function toggleResponsiveMenu() {

//     // let menu = document.getElementById("topnav_responsive_menu");
//     // let icon = document.getElementById("topnav_hamburger_icon");
//     // let root = document.getElementById("root");
   
//     if (menu.className === "") {
//         // menu.className = "open";
//         // icon.className = "open";
//         // // root.style.overflowY = "hidden";
//         openBurgerMenu();
//     } else {
//         // menu.className = "";                    
//         // icon.className = "";
//         // // root.style.overflowY = "";
//         closeBurgerMenu();
//     }
    
// }

// // écoute de l'évènement click sur le menu
// icon.addEventListener("click", toggleResponsiveMenu);

// // pour chaque item (<a>) dans le menu
// document.querySelectorAll("#topnav_responsive_menu a").forEach(menuItem =>
//     // on veut écouter l'évènement click et exécuter une action (quand on clique dessus) => l'action sera de fermer le menu
//     menuItem.addEventListener("click", closeBurgerMenu)
// );



// // scroll to top

// // function scrollToTop() {
// //     window.scrollTo(0, 0);
// // }

// // si on clique sur la flèche du "scroll to top" => on scroll en haut
// // document.querySelector(".top").addEventListener("click", scrollToTop);


// public/js/script.js
// function togglePassword() {
//     var pass1 = document.getElementById('pass1');
//     var showPassword = document.getElementById('showPassword');

//     if (showPassword.checked) {
//         pass1.type = 'text';
//     } else {
//         pass1.type = 'password';
//     }
// }

// // Ajoutez un gestionnaire d'événement pour la case à cocher
// var showPasswordCheckbox = document.getElementById('showPassword');
// showPasswordCheckbox.addEventListener('change', togglePassword);


document.addEventListener("DOMContentLoaded", function() {
    // Sélectionnez toutes les images dans la classe "image-container"
    const images = document.querySelectorAll(".image-container img");
    
    // Sélectionnez les flèches précédente et suivante
    const prevArrow = document.querySelector(".prev-arrow");
    const nextArrow = document.querySelector(".next-arrow");
    
    // Initialisez l'index de l'image actuellement affichée
    let currentImageIndex = 0;
  
    // Fonction pour afficher une image en fonction de l'index
    function showImage(index) {
      images.forEach((image, i) => {
        if (i === index) {
          image.style.display = "block";
        } else {
          image.style.display = "none";
        }
      });
      currentImageIndex = index;
    }
    
    // Fonction pour afficher l'image précédente
    function previousImage() {
      const newIndex = (currentImageIndex - 1 + images.length) % images.length;
      showImage(newIndex);
    }
    
    // Fonction pour afficher l'image suivante
    function nextImage() {
      const newIndex = (currentImageIndex + 1) % images.length;
      showImage(newIndex);
    }
    
    // Affichez l'image actuelle au chargement de la page
    showImage(currentImageIndex);
    
    // Ajoutez des écouteurs d'événements aux flèches pour la navigation
    prevArrow.addEventListener("click", previousImage);
    nextArrow.addEventListener("click", nextImage);
  });


//----------------------------------------------------------------------

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var burgerMenu = document.getElementById('burger-menu');
        var nav = document.getElementById('nav'); // Assurez-vous que 'nav' est l'ID de votre menu de navigation

        burgerMenu.addEventListener('click', function () {
            if (nav.style.display === 'block') {
                nav.style.display = 'none';
            } else {
                nav.style.display = 'block';
            }
        });
    });
</script>