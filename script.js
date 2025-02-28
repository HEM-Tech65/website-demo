document.getElementById("login-form").addEventListener("submit", function (e) {
    e.preventDefault();

    const email = document.getElementById("email").value;
    const password = document.getElementById("password").value;
    const role = this.getAttribute("data-role");

    fetch("login.php", {
        method: "POST",
        headers: { "Content-Type": "application/x-www-form-urlencoded" },
        body: `email=${encodeURIComponent(email)}&password=${encodeURIComponent(password)}&role=${encodeURIComponent(role)}`,
    })
        .then((response) => response.json())
        .then((data) => {
            if (data.success) {
                window.location.href = data.redirect_url;
            } else {
                document.getElementById("password-error").innerText = data.message;
            }
        });
});
