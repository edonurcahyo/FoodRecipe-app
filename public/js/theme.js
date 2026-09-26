(function () {
    const themeToggle = document.getElementById('theme-toggle');
    if (!themeToggle) return;

    const sunIcon = themeToggle.querySelector('.icon-sun');
    const moonIcon = themeToggle.querySelector('.icon-moon');

    function applyTheme(theme) {
        document.body.classList.toggle('dark', theme === 'dark');
        sunIcon.style.display = theme === 'dark' ? 'none' : 'inline';
        moonIcon.style.display = theme === 'dark' ? 'inline' : 'none';
        localStorage.setItem('theme', theme);
    }

    themeToggle.addEventListener('click', function () {
        const isDark = document.body.classList.contains('dark');
        applyTheme(isDark ? 'light' : 'dark');
    });

    // Init on load (avoid flash)
    const savedTheme = localStorage.getItem('theme') || 'light';
    applyTheme(savedTheme);
})();