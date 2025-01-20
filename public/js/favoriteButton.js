window.onload = function() {
    // Selektujemo sve formulare za dodavanje i uklanjanje iz favorita
    document.querySelectorAll('form.favorites-property-form').forEach(function(form) {
        form.addEventListener('submit', function(event) {
            event.preventDefault();
            const isRemovingFromFavorites = form.id.startsWith('remove'); // Provera da li se uklanja iz favorita

            if (isRemovingFromFavorites) {
                // Prikazivanje modala samo kada se uklanja iz favorita
                const confirmRemoval = confirm('Da li ste sigurni da želite da uklonite ovaj objekat iz favorita?');
                if (confirmRemoval) {
                    this.submit(); // Podnosi formu ako je korisnik potvrdio uklanjanje
                }
            } else {
                // Ako se dodaje u favorite, odmah podnosi formu bez potvrde
                this.submit();
            }
        });
    });
}
