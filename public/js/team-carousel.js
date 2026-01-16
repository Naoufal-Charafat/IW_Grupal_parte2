/**
 * Team Carousel - Auto-scroll professional cards
 * Scrolls one card at a time every 3 seconds
 */

document.addEventListener('DOMContentLoaded', function () {
    const carousel = document.getElementById('teamCarousel');
    const track = carousel?.querySelector('.team-carousel-track');
    const prevBtn = document.getElementById('teamPrev');
    const nextBtn = document.getElementById('teamNext');

    if (!track || !prevBtn || !nextBtn) return;

    const items = track.querySelectorAll('.team-carousel-item');
    const totalItems = items.length;

    let currentIndex = 0;
    let autoScrollInterval;
    let itemsPerView = 4;

    // Calculate items per view based on screen width
    function updateItemsPerView() {
        const width = window.innerWidth;
        if (width < 480) {
            itemsPerView = 1;
        } else if (width < 768) {
            itemsPerView = 2;
        } else if (width < 1024) {
            itemsPerView = 3;
        } else {
            itemsPerView = 4;
        }
    }

    // Update carousel position
    function updateCarousel() {
        const itemWidth = items[0].offsetWidth;
        const gap = 24; // Match CSS gap
        const offset = currentIndex * (itemWidth + gap);
        track.style.transform = `translateX(-${offset}px)`;

        // Update button states
        prevBtn.disabled = currentIndex === 0;
        nextBtn.disabled = currentIndex >= totalItems - itemsPerView;
    }

    // Go to next slide
    function nextSlide() {
        if (currentIndex < totalItems - itemsPerView) {
            currentIndex++;
            updateCarousel();
        } else {
            // Loop back to start
            currentIndex = 0;
            updateCarousel();
        }
    }

    // Go to previous slide
    function prevSlide() {
        if (currentIndex > 0) {
            currentIndex--;
            updateCarousel();
        }
    }

    // Start auto-scroll
    function startAutoScroll() {
        autoScrollInterval = setInterval(nextSlide, 3000); // 3 seconds
    }

    // Stop auto-scroll
    function stopAutoScroll() {
        clearInterval(autoScrollInterval);
    }

    // Event listeners
    nextBtn.addEventListener('click', () => {
        stopAutoScroll();
        nextSlide();
        startAutoScroll();
    });

    prevBtn.addEventListener('click', () => {
        stopAutoScroll();
        prevSlide();
        startAutoScroll();
    });

    // Pause on hover
    carousel.addEventListener('mouseenter', stopAutoScroll);
    carousel.addEventListener('mouseleave', startAutoScroll);

    // Handle window resize
    let resizeTimeout;
    window.addEventListener('resize', () => {
        clearTimeout(resizeTimeout);
        resizeTimeout = setTimeout(() => {
            updateItemsPerView();
            currentIndex = 0;
            updateCarousel();
        }, 250);
    });

    // Initialize
    updateItemsPerView();
    updateCarousel();

    // Start auto-scroll if there are more items than can be displayed
    if (totalItems > itemsPerView) {
        startAutoScroll();
    }
});
