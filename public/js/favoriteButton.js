window.onload = function() {
    document.querySelectorAll('form.favorites-property-form').forEach(function(form) {
        form.addEventListener('submit', function(event) {
            event.preventDefault();
            const isRemovingFromFavorites = form.id.startsWith('remove');
            if (isRemovingFromFavorites) {
                const confirmRemoval = confirm('Da li ste sigurni da želite da uklonite ovaj objekat iz favorita?');
                if (confirmRemoval) {
                    this.submit();
                }
            } else {
                this.submit();
            }
        });
    });
}


