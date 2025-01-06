window.onload = function() {
    // Selektujemo sve formulare za brisanje
    document.querySelectorAll('form[id^="delete-form-"]').forEach(function(form) {
        form.addEventListener('submit', function(event) {
            event.preventDefault();
            if (confirm('Da li ste sigurni da zelite da obrisete ovaj objekat?')) {
                this.submit();
            }
        });
    });
}