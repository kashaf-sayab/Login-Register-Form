document.addEventListener('DOMContentLoaded', function() {
    const loginForm = document.getElementById('login-form');
    const registerForm = document.getElementById('register-form');

    if (loginForm) {
        loginForm.addEventListener('submit', function(event) {
            event.preventDefault();
            const email = document.getElementById('login-email').value;
            const password = document.getElementById('login-password').value;
            
            if (!validateEmail(email)) {
                alert('Please enter a valid email.');
            } else if (!validatePassword(password)) {
                alert('Password must be at least 8 characters long and contain a mix of letters, numbers, and special characters.');
            } else {
                alert('Login successful!');
                loginForm.submit();
            }
        });
    }

    if (registerForm) {
        registerForm.addEventListener('submit', function(event) {
            event.preventDefault();
            const email = document.getElementById('register-email').value;
            const password = document.getElementById('register-password').value;
            const confirmPassword = document.getElementById('register-confirm-password').value;
            
            if (!validateEmail(email)) {
                alert('Please enter a valid email.');
            } else if (!validatePassword(password)) {
                alert('Password must be at least 8 characters long and contain a mix of letters, numbers, and special characters.');
            } else if (password !== confirmPassword) {
                alert('Passwords do not match.');
            } else {
                alert('Registration successful!');
                registerForm.submit();
            }
        });
    }

    function validateEmail(email) {
        const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return re.test(String(email).toLowerCase());
    }

    function validatePassword(password) {
        const re = /^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;
        return re.test(String(password));
    }
});
