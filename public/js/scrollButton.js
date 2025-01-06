document.addEventListener('DOMContentLoaded', function() {
    const scrollButton = document.getElementById('scrollToTopBtn');
    const scrollThreshold = 300; // Show button after scrolling 300px

    // Show/hide button based on scroll position
    function toggleScrollButton() {
        if (window.scrollY > scrollThreshold) {
            scrollButton.classList.remove('opacity-0');
            scrollButton.classList.add('opacity-100');
        } else {
            scrollButton.classList.remove('opacity-100');
            scrollButton.classList.add('opacity-0');
        }
    }

    // Smooth scroll to top
    function scrollToTop() {
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
    }

    // Event listeners
    window.addEventListener('scroll', toggleScrollButton);
    scrollButton.addEventListener('click', scrollToTop);
});