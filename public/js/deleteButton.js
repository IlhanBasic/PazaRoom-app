document.addEventListener("DOMContentLoaded", function () {
    document
        .querySelectorAll('form[id^="delete-form-"]')
        .forEach(function (form) {
            form.addEventListener("submit", function (event) {
                event.preventDefault();
                const confirmRemoval = confirm(
                    "Da li ste sigurni da želite da uklonite ovaj objekat?"
                );
                if (confirmRemoval) {
                    this.submit();
                }
            });
        });
});


