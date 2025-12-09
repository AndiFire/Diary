
function togglePasswordVisibility() {
    const passwordInput = document.getElementById('password');
    const eyeIconClosed = document.querySelector('.eye-closed');
    const eyeIconOpen = document.querySelector('.eye-open');

    if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        eyeIconClosed.style.display = 'none';
        eyeIconOpen.style.display = 'block';
    } else {
        passwordInput.type = 'password';
        eyeIconClosed.style.display = 'block';
        eyeIconOpen.style.display = 'none';
    }
}
function toggleConfirmPasswordVisibility() {
    const confirmPasswordInput = document.getElementById('password_confirm');
    const eyeIconClosed = document.querySelector('.eye-closed-confirm');
    const eyeIconOpen = document.querySelector('.eye-open-confirm');

    if (confirmPasswordInput.type === 'password') {
        confirmPasswordInput.type = 'text';
        eyeIconClosed.style.display = 'none';
        eyeIconOpen.style.display = 'block';
    } else {
        confirmPasswordInput.type = 'password';
        eyeIconClosed.style.display = 'block';
        eyeIconOpen.style.display = 'none';
    }
}

function toggleNewPasswordVisibility() {
    const newPasswordInput = document.getElementById('new_password');
    const eyeIconClosed = document.querySelector('.eye-closed-new');
    const eyeIconOpen = document.querySelector('.eye-open-new');

    if (newPasswordInput.type === 'password') {
        newPasswordInput.type = 'text';
        eyeIconClosed.style.display = 'none';
        eyeIconOpen.style.display = 'block';
    } else {
        newPasswordInput.type = 'password';
        eyeIconClosed.style.display = 'block';
        eyeIconOpen.style.display = 'none';
    }
}

function toggleCurrentPasswordVisibility() {
    const currentPasswordInput = document.getElementById('current_password');
    const eyeIconClosed = document.querySelector('.eye-closed-current');
    const eyeIconOpen = document.querySelector('.eye-open-current');

    if (currentPasswordInput.type === 'password') {
        currentPasswordInput.type = 'text';
        eyeIconClosed.style.display = 'none';
        eyeIconOpen.style.display = 'block';
    } else {
        currentPasswordInput.type = 'password';
        eyeIconClosed.style.display = 'block';
        eyeIconOpen.style.display = 'none';
    }
}
