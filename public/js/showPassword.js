function initShowPassword() {
    const $passwordFields = document.querySelectorAll(".input__password");
    const eyeOpen = `<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-eye-icon lucide-eye"><path d="M2.062 12.348a1 1 0 0 1 0-.696 10.75 10.75 0 0 1 19.876 0 1 1 0 0 1 0 .696 10.75 10.75 0 0 1-19.876 0"/><circle cx="12" cy="12" r="3"></circle></svg>`;
    const eyeClosed = `<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-eye-off-icon lucide-eye-off"><path d="M10.733 5.076a10.744 10.744 0 0 1 11.205 6.575 1 1 0 0 1 0 .696 10.747 10.747 0 0 1-1.444 2.49"/><path d="M14.084 14.158a3 3 0 0 1-4.242-4.242"/><path d="M17.479 17.499a10.75 10.75 0 0 1-15.417-5.151 1 1 0 0 1 0-.696 10.75 10.75 0 0 1 4.446-5.143"/><path d="m2 2 20 20"></path></svg>`;
   
    if (!$passwordFields) return;
    $passwordFields.forEach((field) => {
        const $passwordInput = field.querySelector("input");
        const $passwordButton = field.querySelector("button");

        if (!$passwordInput || !$passwordButton) return;

        $passwordButton.addEventListener("click", () => {
            $passwordInput.type =
                $passwordInput.type === "password" ? "text" : "password";
            $passwordButton.innerHTML =
                $passwordInput.type === "password" ? eyeOpen : eyeClosed;
        });
        $passwordButton.innerHTML =
            $passwordInput.type === "password" ? eyeOpen : eyeClosed;
    });
}

export default initShowPassword;
