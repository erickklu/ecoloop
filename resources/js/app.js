import './bootstrap';
import 'bootstrap/dist/js/bootstrap.bundle.min';
import '../sass/app.scss';
import Swal from 'sweetalert2';

//Función para el toast de sweetalert
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

//Método para mostrar el toast
document.addEventListener('DOMContentLoaded', () => {
    const successMessageElement = document.querySelector('meta[name="success-message"]');
    if (successMessageElement) {
        const successMessage = successMessageElement.getAttribute('content');
        if (successMessage) {
            showToast(successMessage, 'success');
        }
    }
});

//Shadow del navbar
document.addEventListener('DOMContentLoaded', () => {
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

    /* //Rating de estrellas para calificación
    const ratingInputs = document.querySelectorAll('.rating input[type="radio"]');
    const ratingLabels = document.querySelectorAll('.rating input[type="radio"] + label');
    const ratingForm = document.querySelector('.rating-form form');

    if (ratingInputs.length > 0 && ratingLabels.length > 0 && ratingForm) {
        ratingLabels.forEach(label => {
            label.addEventListener('click', (e) => {
                const value = label.getAttribute('data-value');

                ratingLabels.forEach(l => l.classList.remove('selected'));

                ratingLabels.forEach(l => {
                    if (l.getAttribute('data-value') <= value) {
                        l.classList.add('selected');
                    }
                });
            });
        });

        ratingForm.addEventListener('submit', () => {
            ratingLabels.forEach(label => label.classList.remove('selected'));
        });

        const checkedInput = document.querySelector('.rating input[type="radio"]:checked');
        if (checkedInput) {
            const checkedValue = checkedInput.value;
            ratingLabels.forEach(label => {
                if (label.getAttribute('data-value') <= checkedValue) {
                    label.classList.add('selected');
                }
            });
        }
    } */

    const ratingInputs = document.querySelectorAll('.rating input[type="radio"]');
    const ratingLabels = document.querySelectorAll('.rating input[type="radio"] + label');

    if (ratingInputs.length > 0 && ratingLabels.length > 0) {
        ratingLabels.forEach(label => {
            label.addEventListener('click', () => {
                const value = label.getAttribute('data-value');

                ratingLabels.forEach(l => l.classList.remove('selected'));
               
                ratingLabels.forEach(l => {
                    if (l.getAttribute('data-value') <= value) {
                        l.classList.add('selected');
                    }
                });
            });
        });

        // Asegúrate de que la estrella seleccionada se muestre correctamente al cargar la página
        const checkedInput = document.querySelector('.rating input[type="radio"]:checked');
        if (checkedInput) {
            const checkedValue = checkedInput.value;
            ratingLabels.forEach(label => {
                if (label.getAttribute('data-value') <= checkedValue) {
                    label.classList.add('selected');
                }
            });
        }
    }
});


