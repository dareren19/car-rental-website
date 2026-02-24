const navBtn = document.querySelector('.header__collapse--btn');
const nav = document.querySelector('.nav');
const navWrapper = document.querySelector('.navWrapper');
const navClose = document.querySelector('.nav__close');

// Start Toggle Header profile
const toggleProfileNav = document.querySelector('.header-profile');
const showProfileNav = document.querySelector('.header-profile-nav');
toggleProfileNav.addEventListener('click', () => {
    showProfileNav.classList.toggle('show');
});
// End Toggle Header profile

// Start Add/Edit modal button
/*const showAddModal = document.querySelector(
    '.modal'
);
const toggleShowModal = document.querySelectorAll(
    '.open-modal'
);
const closeShowModal = document.querySelectorAll(
    '.close-modal'
);



function openModal(i) {
   // closeShowModal()
    showAddModal.classList.toggle('show');
    //overlay.classList.remove('hidden');
};

for (let i = 0; i < toggleShowModal.length; i++) {
    toggleShowModal[i].addEventListener('click', () => {
         showAddModal.classList.toggle('show');
    }, false);
}

closeShowModal.forEach((btn) => {
    btn.addEventListener('click', () => {
        showAddModal.classList.toggle('show');
    });
});

// Start Toggle Header profile
const toggleProfileNav = document.querySelector('.header-profile');
const showProfileNav = document.querySelector('.header-profile-nav');
toggleProfileNav.addEventListener('click', () => {
    showProfileNav.classList.toggle('show');
});*/
// End Toggle Header profile

// Start Add/Edit modal button - invoice
const modals = document.querySelectorAll('.modal');
const btnsCloseModal = document.querySelectorAll('.close-modal');
const btnsOpenModal = document.querySelectorAll('.open-modal');

function openModal(i) {
   modals[i].classList.add('show');
};

function closeModal() {
    for (let i = 0; i < modals.length; i++) {
        modals[i].classList.remove('show');
    }
};
for (let i = 0; i < btnsOpenModal.length; i++) {
    btnsOpenModal[i].addEventListener('click', () => {
        openModal(i)
    }, false);
}
for (let i = 0; i < btnsCloseModal.length; i++) {
    btnsCloseModal[i].addEventListener('click', closeModal, false);
}

