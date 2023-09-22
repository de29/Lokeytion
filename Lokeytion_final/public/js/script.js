//SLIDE COMMENTS
var swiper = new Swiper(".row", {
  slidesPerView: 2,
  spaceBetween: 20,
  sliderPerGroup: 2,
  loop: true,
  centerSlide: "true",
  fade: "true",
  grabCursor: "true",
  pagination: {
    el: ".swiper-pagination",
    clickable: true,
    dynamicBullets: true,
  },
  navigation: {
    nextEl: ".swiper-button-next",
    prevEl: ".swiper-button-prev",
  },

  breakpoints: {
    0: {
      slidesPerView: 1,
    },
    520: {
      slidesPerView: 2,
    },
  },
});


//DROPDOWN LIST
let profileDropdownList = document.querySelector(".profile-dropdown-list");
let btn = document.querySelector(".profile-dropdown-btn");

let classList = profileDropdownList.classList;

const toggle = () => classList.toggle("active");

window.addEventListener("click", function (e) {
  if (!btn.contains(e.target)) classList.remove("active");
});

//IMAGES DESC
let mainImg1 = document.querySelector('.img-holder img');

function showImg(pic){
  mainImg1.src = pic;
}


//MODAL EDIT PROFILE
const exampleModal = document.getElementById('exampleModal')
if (exampleModal) {
  exampleModal.addEventListener('show.bs.modal', event => {
    // Button that triggered the modal
    const button = event.relatedTarget
    // Extract info from data-bs-* attributes
    const recipient = button.getAttribute('data-bs-whatever')
    // If necessary, you could initiate an Ajax request here
    // and then do the updating in a callback.

    // Update the modal's content.
    const modalTitle = exampleModal.querySelector('.modal-title')
    const modalBodyInput = exampleModal.querySelector('.modal-body input')

    modalTitle.textContent = 'Mon profile'
    modalBodyInput.value = recipient
  })
}



//MODAL Messages
const exampleModal1 = document.getElementById('exampleModal1')
if (exampleModal1) {
  exampleModal1.addEventListener('show.bs.modal', event => {
    // Button that triggered the modal
    const button1 = event.relatedTarget
    // Extract info from data-bs-* attributes
    const recipient1 = button.getAttribute('data-bs-whatever')
    // If necessary, you could initiate an Ajax request here
    // and then do the updating in a callback.

    // Update the modal's content.
    const modalTitle1 = exampleModal1.querySelector('.modal-title1')
    const modalBodyInput1 = exampleModal1.querySelector('.modal-body1 input')

    modalTitle1.textContent = 'Messages'
    modalBodyInput1.value = recipient
  })
}

