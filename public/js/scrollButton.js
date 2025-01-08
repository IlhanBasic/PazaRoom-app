document.addEventListener('DOMContentLoaded', function() {
    const scrollButton = document.getElementById('scrollToTopBtn');
    const scrollThreshold = 300;

    function toggleScrollButton() {
        if (window.scrollY > scrollThreshold) {
            scrollButton.classList.add('show');
            scrollButton.style.opacity = '1';
        } else {
            scrollButton.style.opacity = '0';
            setTimeout(() => { 
                if (window.scrollY <= scrollThreshold) {
                    scrollButton.classList.remove('show');
                }
            }, 300);
        }
    }

    function scrollToTop() {
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
    }

    window.addEventListener('scroll', toggleScrollButton);
    scrollButton.addEventListener('click', scrollToTop);
});


