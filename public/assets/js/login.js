document.addEventListener('DOMContentLoaded', function () {

    const form = document.getElementById("loginForm");
    const credentialInput = document.getElementById("credential");
    const passwordInput = document.getElementById("password");

    const credentialError = document.getElementById("credentialError");
    const passwordError = document.getElementById("passwordError");

    const togglePassword = document.getElementById('togglePassword');
    const loginButton = document.getElementById("loginButton");

    const CREDENTIAL_MIN_LENGTH = 3;
    const PASSWORD_MIN_LENGTH = 8;

    const originalButtonHTML = loginButton
        ? loginButton.innerHTML
        : "";

    const showError = (element, message) => {
        if (!element) {
            return;
        }

        element.textContent = message;
    };

    const clearError = (element) => {
        if (!element) {
            return;
        }

        element.textContent = "";
    };

    const validateCredential = () => {

        if (!credentialInput) {
            return false;
        }

        const value = credentialInput.value.trim();

        if (value === "") {
            showError(
                credentialError,
                "Username atau email wajib diisi."
            );

            return false;
        }

        if (value.length < CREDENTIAL_MIN_LENGTH) {
            showError(
                credentialError,
                `Username atau email minimal ${CREDENTIAL_MIN_LENGTH} karakter.`
            );

            return false;
        }

        clearError(credentialError);

        return true;
    };

    const validatePassword = () => {

        if (!passwordInput) {
            return false;
        }

        const value = passwordInput.value;

        if (value === "") {
            showError(
                passwordError,
                "Password wajib diisi."
            );

            return false;
        }

        if (value.length < PASSWORD_MIN_LENGTH) {
            showError(
                passwordError,
                `Password minimal ${PASSWORD_MIN_LENGTH} karakter.`
            );

            return false;
        }

        clearError(passwordError);

        return true;
    };

    if (togglePassword && passwordInput) {

        togglePassword.addEventListener("click", () => {

            const shouldShowPassword =
                passwordInput.type === "password";

            passwordInput.type =
                shouldShowPassword ? "text" : "password";

            togglePassword.innerHTML = shouldShowPassword
                ? '<i class="bi bi-eye-slash" aria-hidden="true"></i>'
                : '<i class="bi bi-eye" aria-hidden="true"></i>';

            togglePassword.setAttribute(
                "aria-label",
                shouldShowPassword
                    ? "Sembunyikan password"
                    : "Tampilkan password"
            );

            togglePassword.setAttribute(
                "title",
                shouldShowPassword
                    ? "Sembunyikan password"
                    : "Tampilkan password"
            );
        });
    }

    if (credentialInput) {

        credentialInput.addEventListener("input", () => {
            clearError(credentialError);
        });
    }

    if (passwordInput) {

        passwordInput.addEventListener("input", () => {
            clearError(passwordError);
        });
    }

    if (form) {

        form.addEventListener("submit", (event) => {

            const credentialValid = validateCredential();
            const passwordValid = validatePassword();

            if (!credentialValid || !passwordValid) {

                event.preventDefault();

                if (!credentialValid && credentialInput) {
                    credentialInput.focus();
                    return;
                }

                if (!passwordValid && passwordInput) {
                    passwordInput.focus();
                }

                return;
            }

            if (loginButton) {

                loginButton.disabled = true;

                loginButton.innerHTML = `
                    <span
                        class="spinner-border spinner-border-sm me-2"
                        role="status"
                        aria-hidden="true">
                    </span>
                    <span>Memproses...</span>
                `;
            }
        });
    }

    window.addEventListener("pageshow", (event) => {

        if (!loginButton) {
            return;
        }

        if (event.persisted || loginButton.disabled) {

            loginButton.disabled = false;
            loginButton.innerHTML = originalButtonHTML;
        }
    });
});