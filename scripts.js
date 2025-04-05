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

document.addEventListener("DOMContentLoaded", () => {
    // Simulate login (for now, replace with actual session handling later)
    document.getElementById("loginForm")?.addEventListener("submit", (e) => {
        e.preventDefault();

        const username = document.getElementById("loginUsername").value;
        const password = document.getElementById("loginPassword").value;

        // Dummy Admin Check (Replace with PHP session check)
        if (username === "admin" && password === "admin") {
            localStorage.setItem("userRole", "admin"); // Store role
            window.location.href = "Users/admin.html"; // Redirect to Admin Page
        } else {
            localStorage.setItem("userRole", "user"); // Store role
            window.location.href = "user.html"; // Redirect to User Page
        }
    });

    // Check role when loading pages
    const userRole = localStorage.getItem("userRole");
    
    if (document.body.contains(document.getElementById("adminControls"))) {
        if (userRole !== "admin") {
            document.getElementById("adminControls").style.display = "none"; // Hide admin buttons
        }
    }
});

function changeBackgroundColor() {
    const selectedColor = document.getElementById("bgColorSelect").value;
    document.body.style.backgroundColor = selectedColor;
    localStorage.setItem("adminBackgroundColor", selectedColor); // Save preference
}

document.addEventListener("DOMContentLoaded", function () {
    const bgColorSelect = document.getElementById("bgColorSelect");

    // Function to change the background color and store it
    function changeBackgroundColor() {
        const selectedColor = bgColorSelect.value;
        document.body.style.backgroundColor = selectedColor;
        localStorage.setItem("adminBackgroundColor", selectedColor); // Save preference
    }

    // Load saved background color
    const savedColor = localStorage.getItem("adminBackgroundColor");
    if (savedColor) {
        document.body.style.backgroundColor = savedColor;
        bgColorSelect.value = savedColor;
    }

    // Listen for changes in the dropdown
    bgColorSelect.addEventListener("change", changeBackgroundColor);
});

document.addEventListener("DOMContentLoaded", () => {
    const themeSelector = document.getElementById("theme");
    if (!themeSelector) return; // Exit if selector isn't present

    const savedTheme = localStorage.getItem("theme") || "light";
    document.documentElement.setAttribute("data-theme", savedTheme);
    themeSelector.value = savedTheme;

    themeSelector.addEventListener("change", function () {
        const selected = this.value;
        document.documentElement.setAttribute("data-theme", selected);
        localStorage.setItem("theme", selected);
    });
});