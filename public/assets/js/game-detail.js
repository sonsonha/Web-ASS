document.addEventListener("DOMContentLoaded", function () {
    const thumbnails = document.querySelectorAll(".thumbnail");
    const mainDisplay = document.getElementById("mainDisplay");
    const imageDisplay = document.getElementById("imageDisplay");
    const videoSource = document.getElementById("videoSource");

    thumbnails.forEach(thumbnail => {
        thumbnail.addEventListener("click", function () {
            const type = this.getAttribute("data-type");
            if (type === "image") {
                // Display image
                mainDisplay.style.display = "none";
                imageDisplay.style.display = "block";
                imageDisplay.src = this.src;
            } else if (type === "video") {
                // Display video
                imageDisplay.style.display = "none";
                mainDisplay.style.display = "block";
                videoSource.src = this.getAttribute("data-src");
                mainDisplay.load(); // Reload the video source
                mainDisplay.play(); // Auto-play the video
            }
        });
    });
});
