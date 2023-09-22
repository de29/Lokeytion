   // Fonction pour afficher la fenêtre modale
   function showModal(imageSrc) {
    var modal = document.getElementById("modal");
    var modalImg = document.getElementById("modal-img");
    modal.style.display = "block";
    modalImg.src = imageSrc; // Chemin de l'image à afficher dans la fenêtre modale
}

// Fonction pour masquer la fenêtre modale
function hideModal() {
    var modal = document.getElementById("modal");
    modal.style.display = "none";
}