document.addEventListener("DOMContentLoaded", function () {
    const errorAlert = document.getElementById("errorAlert");

    if (errorAlert) {
        setTimeout(function () {
            errorAlert.classList.remove("show");  // Hide the alert
        }, 800);  // 0.8 seconds
    }
});