import './bootstrap';
import 'bootstrap/dist/js/bootstrap.bundle.min';
import '../sass/app.scss';


document.addEventListener('DOMContentLoaded', () => {
    const navbar = document.querySelector('.navbar');

    window.addEventListener('scroll', () => {
        if (window.scrollY > 0) {
            navbar.classList.add('navbar-shadow');
        } else {
            navbar.classList.remove('navbar-shadow');
        }
    });
});

document.addEventListener('DOMContentLoaded', () => {
    const ratingInputs = document.querySelectorAll('.rating input[type="radio"]');
    const ratingLabels = document.querySelectorAll('.rating input[type="radio"] + label');
    const ratingForm = document.querySelector('.rating-form form');

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

    // Remover la clase selected al enviar el formulario
    ratingForm.addEventListener('submit', () => {
        ratingLabels.forEach(label => label.classList.remove('selected'));
    });
});