document.addEventListener('DOMContentLoaded', function () {
    const carousel = document.getElementById('gameCarousel');
    const trendingSection = document.getElementById('trendingCarousel');

    // Change background on slide
    carousel.addEventListener('slide.bs.carousel', function (event) {
        const nextSlide = event.relatedTarget; // Next active slide
        const bgImage = nextSlide.getAttribute('data-bg'); // Get background image
        trendingSection.style.backgroundImage = `radial-gradient(
            circle,
            transparent 60%,
            rgba(0, 0, 0, 0.8) 80%,
            #1b2838 100%
        ), url(${bgImage})`; // Change background
    });
});



