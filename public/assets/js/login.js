document.addEventListener('DOMContentLoaded', function () {

    const togglePassword = document.getElementById('togglePassword');
    const password = document.getElementById('password');

    if (!togglePassword || !password) {
        return;
    }

    togglePassword.addEventListener('click', function () {

        const isPassword = password.type === 'password';

        password.type = isPassword ? 'text' : 'password';

        this.innerHTML = isPassword
            ? '<i class="bi bi-eye-slash"></i>'
            : '<i class="bi bi-eye"></i>';

        this.setAttribute(
            'aria-label',
            isPassword ? 'Sembunyikan password' : 'Tampilkan password'
        );
    });

});