document.addEventListener('DOMContentLoaded', function() {
    var currentLocation = window.location.href;
    var navLinks = document.querySelectorAll('.nav-link');

    navLinks.forEach(function(navLink) {
        if (navLink.href === currentLocation) {
            navLink.classList.add('active');
        }
    });
});
