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
            function checkEmailExists(email, callback) {
                const xhr = new XMLHttpRequest();
                xhr.open('POST', 'check_email.php', true);
                xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

                xhr.onload = function() {
                    if (xhr.status === 200) {
                        const response = JSON.parse(xhr.responseText);
                        callback(response);
                    } else {
                        alert('Error checking email.');
                    }
                };

                xhr.send('email=' + encodeURIComponent(email));
            }
            checkEmailExists(email, function(response) {
                if (response.exists) {
                    alert('Email is already in use.');
                    return;
                }

                if (email.indexOf('@') <= 0 || email.lastIndexOf('.') <= email.indexOf('@') || email.lastIndexOf('.') >= email.length - 1) {
                    alert('Please enter a valid email.');
                    return;
                }
                if (password.length < 8) {
                    alert('Password must be at least 8 characters long.');
                    return;
                }

                let hasUppercase = false;
                let hasSpecialChar = false;
                let hasNumber = false;

                for (let i = 0; i < password.length; i++) {
                    if (password[i] >= 'A' && password[i] <= 'Z') {
                        hasUppercase = true;
                    }
                    if (password[i] >= '0' && password[i] <= '9') {
                        hasNumber = true;
                    }
                    if (['@', '$', '!', '%', '*', '?', '&'].includes(password[i])) {
                        hasSpecialChar = true;
                    }
                }

                if (!hasUppercase || !hasSpecialChar || !hasNumber) {
                    alert('Password must include at least one uppercase letter, one number, and one special character.');
                    return;
                }
                if (password !== confirmPassword) {
                    alert('Passwords do not match.');
                    return;
                }

                alert('Registration successful!');
                registerForm.submit();
            });
        });
    }
});

