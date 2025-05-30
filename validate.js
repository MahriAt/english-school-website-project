document.addEventListener("DOMContentLoaded", function () {
    const form = document.getElementById("registrationForm");
    const result = document.getElementById("resultMessage");

    form.addEventListener("submit", function (e) {
        e.preventDefault(); // prevent default form submit

        const formData = new FormData(form);

        fetch("register.php", {
            method: "POST",
            body: formData
        })
        .then(response => response.text())
        .then(data => {
            result.innerHTML = data;
            result.style.color = data.includes("successful") ? "green" : "red";
            form.reset(); // optional: reset form after submission
        })
        .catch(error => {
            result.innerHTML = "Error submitting form.";
            result.style.color = "red";
            console.error("AJAX error:", error);
        });
    });
});