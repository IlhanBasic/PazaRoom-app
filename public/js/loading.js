window.onload = function() {
    document.getElementById('form').addEventListener('submit', function(event) {
        event.preventDefault();
        var submitButton = document.getElementById('submit-button');
        document.getElementById('loader').style.display = 'flex';
        submitButton.innerText = 'Loading...';
        submitButton.disabled = true;
        this.submit(); 
    });
}