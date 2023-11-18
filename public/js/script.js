document.addEventListener("DOMContentLoaded", function() {
  // Gestion du menu hamburger
  let menu = document.getElementById("topnav_responsive_menu");
  let icon = document.getElementById("topnav_hamburger_icon");

  // Fonction pour ouvrir le menu hamburger
  function openBurgerMenu() {
    menu.className = "open";
    icon.className = "open";
  }

  // Fonction pour fermer le menu hamburger
  function closeBurgerMenu() {
    menu.className = "";                    
    icon.className = "";
  }

  // Fonction pour basculer entre l'ouverture et la fermeture du menu
  function toggleResponsiveMenu() {
    if (menu.className === "") {
      openBurgerMenu();
    } else {
      closeBurgerMenu();
    }
  }

  // Ajoute un écouteur d'événements pour le clic sur l'icône du hamburger
  icon.addEventListener("click", toggleResponsiveMenu);

  // Ajoute un écouteur d'événements pour chaque lien (<a>) dans le menu
  document.querySelectorAll("#topnav_responsive_menu a").forEach(menuItem =>
    menuItem.addEventListener("click", closeBurgerMenu)
  );

  // Gestion des images avec les flèches
  const images = document.querySelectorAll(".image-container img");
  const prevArrow = document.querySelector(".prev-arrow");
  const nextArrow = document.querySelector(".next-arrow");
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

  // Affiche l'image actuelle au chargement de la page
  showImage(currentImageIndex);

  // Vérifie si prevArrow et nextArrow existent avant d'ajouter des écouteurs d'événements
  if (prevArrow) {
    prevArrow.addEventListener("click", previousImage);
  }

  if (nextArrow) {
    nextArrow.addEventListener("click", nextImage);
  }
});

//----------------------------------------------------------------------

// const container = document.querySelector('.detailArticle-accueil-cards');
// const prevArrow = document.querySelector('.home-prev-arrow');
// const nextArrow = document.querySelector('.home-next-arrow');

// prevArrow.addEventListener('click', () => {
//   container.scrollBy({
//     left: -300,
//     behavior: 'smooth'
//   });
// });

// nextArrow.addEventListener('click', () => {
//   container.scrollBy({
//     left: 300,
//     behavior: 'smooth'
//   });
// });

