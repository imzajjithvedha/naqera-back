//
// Submit button loading state
document.addEventListener("submit", (e) => {
    if (e.defaultPrevented) return;
    const button = e.target.querySelector('button[type="submit"]');
    if (button) {
        button.disabled = true;
        button.textContent = "";
        button.classList.add("submit-button-submitting");

        const spinner = document.createElement("span");
        spinner.classList.add("submit-button-spinner");
        button.appendChild(spinner);
    }
});

// Password visibility toggle
document.addEventListener("click", (e) => {
    const btn = e.target.closest(".toggle-password");
    if (!btn) return;
    const input = btn.closest("div").querySelector("input");
    if (!input) return;
    const icon = btn.querySelector("i");
    if (input.type === "password") {
        input.type = "text";
        icon?.classList.replace("bi-eye-slash-fill", "bi-eye-fill");
    } else {
        input.type = "password";
        icon?.classList.replace("bi-eye-fill", "bi-eye-slash-fill");
    }
});