function menuBar(icon) {
    const menuNav = document.getElementById('menuNav');

    if (icon.classList.contains('fa-bars')) {
        icon.classList.remove('fa-bars');
        icon.classList.add('fa-xmark');
        menuNav.style.display = 'flex';
    } else {
        icon.classList.add('fa-bars');
        icon.classList.remove('fa-xmark');
        menuNav.style.display = 'none';
    }
}


function menuBar(icon) {
    const closeBar = document.getElementById('closeBar');

    if (icon.classList.contains('fa-bars')) {
        icon.classList.remove('fa-bars');
        icon.classList.add('fa-xmark');
        menuNav.style.display = 'flex';
    } else {
        icon.classList.add('fa-bars');
        icon.classList.remove('fa-xmark');
        menuNav.style.display = 'none';
    }
}