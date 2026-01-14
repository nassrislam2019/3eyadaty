document.addEventListener('DOMContentLoaded', () => {
    const alertEls = document.querySelectorAll('.alert');
    alertEls.forEach((el) => {
        setTimeout(() => el.classList.add('fade'), 5000);
    });
});
