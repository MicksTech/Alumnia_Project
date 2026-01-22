function login(event) {
    event.preventDefault();

    const user = document.getElementById('user').value;
    const password = document.getElementById('password').value;
    const button = event.target.querySelector('button');
    const originalText = button.textContent;

    button.textContent = 'Logging in...';
    button.disabled = true;

    setTimeout(() => {
        if (user === '' && password === '') {
            alert('Welcome user');
            window.location.href = '/landing/landing.html';
        } else {
            alert('User not found');
            button.textContent = originalText;
            button.disabled = false;
        }
    }, 1500);
}

function Showpass(icon) {
    const password = document.getElementById('password');

    if (password.type === 'password') {
        password.type = 'text';
        icon.classList.replace('fa-eye-slash', 'fa-eye');
    } else {
        password.type = 'password';
        icon.classList.replace('fa-eye', 'fa-eye-slash');
    }
}