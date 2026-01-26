document.addEventListener('DOMContentLoaded', function () {
    const mobileMenuButton = document.getElementById('mobile-menu-button');
    const mobileMenu = document.getElementById('mobile-menu');

    mobileMenuButton.addEventListener('click', function () {
        mobileMenu.classList.toggle('hidden');

        // Optional: Change icon when menu is open
        const icon = mobileMenuButton.querySelector('svg');
        if (mobileMenu.classList.contains('hidden')) {
            // Menu is closed - show hamburger icon
            icon.innerHTML = `
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                      d="M4 6h16M4 12h16M4 18h16"></path>
            `;
        } else {
            // Menu is open - show X icon
            icon.innerHTML = `
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                      d="M6 18L18 6M6 6l12 12"></path>
            `;
        }
    });

    // Close mobile menu when clicking on a link
    const mobileLinks = mobileMenu.querySelectorAll('a');
    mobileLinks.forEach(link => {
        link.addEventListener('click', function () {
            mobileMenu.classList.add('hidden');
            // Reset to hamburger icon
            const icon = mobileMenuButton.querySelector('svg');
            icon.innerHTML = `
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                      d="M4 6h16M4 12h16M4 18h16"></path>
            `;
        });
    });
});

currentDate = new Date();
year = currentDate.getFullYear();
document.getElementById("currentDate").innerHTML = "©copy rights " + year;