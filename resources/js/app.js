import './bootstrap';
import 'bootstrap/dist/js/bootstrap.bundle.min';
import '../sass/app.scss';
import Swal from 'sweetalert2';

window.toggleNavbar = function () {
    const navbarMenu = document.getElementById('navbarMenu');
    if (navbarMenu) {
        navbarMenu.classList.toggle('show');
    }
}

function showToast(message, icon = 'success') {
    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer);
            toast.addEventListener('mouseleave', Swal.resumeTimer);
        }
    });

    Toast.fire({
        icon: icon,
        title: message
    });
}

document.addEventListener('DOMContentLoaded', () => {
    const successMessageElement = document.querySelector('meta[name="success-message"]');
    if (successMessageElement) {
        const successMessage = successMessageElement.getAttribute('content');
        if (successMessage) {
            showToast(successMessage, 'success');
        }
    }

    const navbar = document.querySelector('.navbar');
    if (navbar) {
        window.addEventListener('scroll', () => {
            if (window.scrollY > 0) {
                navbar.classList.add('navbar-shadow');
            } else {
                navbar.classList.remove('navbar-shadow');
            }
        });
    }

    const categoriesContainer = document.querySelector('.categories-container');
    if (categoriesContainer) {
        categoriesContainer.addEventListener('mouseenter', () => {
            categoriesContainer.classList.add('show-scrollbar');
        });
        categoriesContainer.addEventListener('mouseleave', () => {
            categoriesContainer.classList.remove('show-scrollbar');
        });
    }

    const ratingInputs = document.querySelectorAll('.rating input[type="radio"]');
    const ratingLabels = document.querySelectorAll('.rating input[type="radio"] + label');
    if (ratingInputs.length > 0 && ratingLabels.length > 0) {
        ratingLabels.forEach(label => {
            label.addEventListener('click', (e) => {
                const value = label.getAttribute('for').replace('star', '');
                ratingLabels.forEach(l => l.classList.remove('selected'));
                ratingLabels.forEach(l => {
                    if (l.getAttribute('for').replace('star', '') <= value) {
                        l.classList.add('selected');
                    }
                });
            });
            label.addEventListener('mouseenter', () => {
                const value = label.getAttribute('for').replace('star', '');
                ratingLabels.forEach(l => l.classList.remove('hovered'));
                ratingLabels.forEach(l => {
                    if (l.getAttribute('for').replace('star', '') <= value) {
                        l.classList.add('hovered');
                    }
                });
            });
            label.addEventListener('mouseleave', () => {
                ratingLabels.forEach(l => l.classList.remove('hovered'));
            });
        });
        const checkedInput = document.querySelector('.rating input[type="radio"]:checked');
        if (checkedInput) {
            const checkedValue = checkedInput.value;
            ratingLabels.forEach(label => {
                if (label.getAttribute('for').replace('star', '') <= checkedValue) {
                    label.classList.add('selected');
                }
            });
        }
    }
});

var modal = document.getElementById("modalEntryDetail");

var btn = document.getElementById("openModalBtn");

var span = document.getElementsByClassName("close")[0];

btn.onclick = function () {
    modal.style.display = "block";
}

span.onclick = function () {
    modal.style.display = "none";
}

window.onclick = function (event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}

