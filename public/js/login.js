document.addEventListener('DOMContentLoaded', function () {
    const signupForm = document.querySelector('#signupModal form');
    signupForm.addEventListener('submit', function (e) {
        e.preventDefault();

        const password = document.querySelector('#signupPassword').value;
        const confirmPassword = document.querySelector('#signupConfirmPassword').value;
        const errorDiv = document.querySelector('#passwordError');

        if (password !== confirmPassword) {
            errorDiv.style.display = 'block';
            return false;
        }

        errorDiv.style.display = 'none';
        signupForm.submit();
        return true;
    });
});
