/**
 * Hero Carousel - Auto-play video slider
 * Changes slide every 4 seconds
 */

document.addEventListener('DOMContentLoaded', function () {
    const slides = document.querySelectorAll('.carousel-slide');
    const indicators = document.querySelectorAll('.indicator');
    let currentSlide = 0;
    let autoplayInterval;

    // Function to change slide
    function goToSlide(slideIndex) {
        // Remove active class from current slide and indicator
        slides[currentSlide].classList.remove('active');
        indicators[currentSlide].classList.remove('active');

        // Update current slide
        currentSlide = slideIndex;

        // Add active class to new slide and indicator
        slides[currentSlide].classList.add('active');
        indicators[currentSlide].classList.add('active');

        // Play the video of the active slide
        const video = slides[currentSlide].querySelector('video');
        if (video) {
            video.play();
        }

        // Pause videos of inactive slides
        slides.forEach((slide, index) => {
            if (index !== currentSlide) {
                const inactiveVideo = slide.querySelector('video');
                if (inactiveVideo) {
                    inactiveVideo.pause();
                }
            }
        });
    }

    // Function to go to next slide
    function nextSlide() {
        const next = (currentSlide + 1) % slides.length;
        goToSlide(next);
    }

    // Start autoplay
    function startAutoplay() {
        autoplayInterval = setInterval(nextSlide, 4000); // 4 seconds
    }

    // Stop autoplay
    function stopAutoplay() {
        clearInterval(autoplayInterval);
    }

    // Click event for indicators
    indicators.forEach((indicator, index) => {
        indicator.addEventListener('click', () => {
            stopAutoplay();
            goToSlide(index);
            startAutoplay();
        });
    });

    // Pause autoplay on hover
    const carousel = document.getElementById('heroCarousel');
    if (carousel) {
        carousel.addEventListener('mouseenter', stopAutoplay);
        carousel.addEventListener('mouseleave', startAutoplay);
    }

    // Initialize: play first video and start autoplay
    const firstVideo = slides[0].querySelector('video');
    if (firstVideo) {
        firstVideo.play();
    }
    startAutoplay();
});
