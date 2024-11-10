document.addEventListener("DOMContentLoaded", function () {
    console.log("Game Store loaded");
});
document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll(".btn-danger").forEach(button => {
        button.addEventListener("click", function () {
            alert("This item will be removed.");
            // Add your logic to remove the item here
        });
    });

    document.querySelector(".btn-dark").addEventListener("click", function () {
        alert("Change avatar functionality coming soon!");
        // Add your logic for changing avatar here
    });
});

