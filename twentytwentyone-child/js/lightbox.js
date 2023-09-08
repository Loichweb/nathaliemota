function lightbox() {
    const lightboxContainer = document.querySelector(".lightbox");
    const closeBtn = lightboxContainer.querySelector(".lightbox__close");
    const nextBtn = lightboxContainer.querySelector(".lightbox__next");
    const prevBtn = lightboxContainer.querySelector(".lightbox__prev");
    const imageContainer = lightboxContainer.querySelector(".lightbox__container");
    const img = imageContainer.querySelector("img");
    const imageTitle = imageContainer.querySelector("#image-title"); // Élément pour afficher le titre de l'image

    // Les images à afficher dans la lightbox
    const images = document.querySelectorAll('.full_screen');
    let currentImageIndex = 0; // Index de l'image actuelle

    closeBtn.addEventListener("click", function () {
        lightboxContainer.style.display = "none";
    });

    function displayImage(index) {
        if (index >= 0 && index < images.length) {
            const elementUrl = images[index].getAttribute("data-image");
            const elementTitle = images[index].getAttribute("data-post-title"); // Récupérer le titre depuis l'attribut data-title
            img.src = elementUrl;
            imageTitle.textContent = elementTitle; // Mettre à jour le titre de l'image dans la lightbox
            currentImageIndex = index;
        }
    }

    // Gestion du bouton "Suivant"
    nextBtn.addEventListener("click", function () {
        const nextIndex = currentImageIndex + 1;
        displayImage(nextIndex);
    });

    // Gestion du bouton "Précédent"
    prevBtn.addEventListener("click", function () {
        const prevIndex = currentImageIndex - 1;
        displayImage(prevIndex);
    });

    const openlightbox = document.querySelectorAll('.full_screen');
    openlightbox.forEach(function (element, index) {
        element.addEventListener("click", function () {
            lightboxContainer.style.display = "block";
            displayImage(index); // Afficher l'image cliquée
        });
    });
}

lightbox();
