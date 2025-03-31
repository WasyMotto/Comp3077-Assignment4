document.addEventListener("DOMContentLoaded", () => {
    // Theme Toggle
    const themeToggle = document.getElementById("themeToggle");
    if (themeToggle) {
        themeToggle.addEventListener("click", () => {
            document.body.classList.toggle("dark-theme");
            document.body.classList.toggle("third-theme");
            localStorage.setItem("theme", document.body.className);
        });
        document.body.className = localStorage.getItem("theme") || "";
    }
    
    // Form Validation
    document.getElementById("createAccountForm")?.addEventListener("submit", (e) => {
        e.preventDefault();
        alert("Account creation will be handled with PHP.");
    });
    
    document.getElementById("loginForm")?.addEventListener("submit", (e) => {
        e.preventDefault();
        alert("Login functionality will be handled with PHP.");
    });
});