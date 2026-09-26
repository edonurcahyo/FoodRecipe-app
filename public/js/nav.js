(function () {
    const navToggle = document.getElementById('nav-toggle');
    const navMenu = document.getElementById('nav-menu');
    if (!navToggle || !navMenu) return;

    navToggle.addEventListener('click', function () {
        navToggle.classList.toggle('active');
        navMenu.classList.toggle('open');
    });

    // Close menu when a link is clicked (mobile)
    navMenu.querySelectorAll('.nav-link').forEach(function (link) {
        link.addEventListener('click', function () {
            navToggle.classList.remove('active');
            navMenu.classList.remove('open');
        });
    });
})();