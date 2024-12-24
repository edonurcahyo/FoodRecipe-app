document.getElementById('theme-toggle').addEventListener('click', function() {
    document.body.classList.toggle('dark');
    const theme = document.body.classList.contains('dark') ? 'dark' : 'light';
    localStorage.setItem('theme', theme);

    const sunIcon = document.querySelector('.icon-sun');
    const moonIcon = document.querySelector('.icon-moon');
    if (theme === 'dark') {
        sunIcon.style.display = 'none';
        moonIcon.style.display = 'inline';
    } else {
        sunIcon.style.display = 'inline';
        moonIcon.style.display = 'none';
    }
});

window.onload = function() {
    const theme = localStorage.getItem('theme');
    if (theme === 'dark') {
        document.body.classList.add('dark');
        document.querySelector('.icon-sun').style.display = 'none';
        document.querySelector('.icon-moon').style.display = 'inline';
    } else {
        document.querySelector('.icon-sun').style.display = 'inline';
        document.querySelector('.icon-moon').style.display = 'none';
    }
};