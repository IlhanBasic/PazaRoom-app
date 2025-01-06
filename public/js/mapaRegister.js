   // Inicijalizacija mape
   const map = L.map('map').setView([43.1333, 20.5100], 13); 

   // Dodavanje OpenStreetMap sloja
   L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
       attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
   }).addTo(map);

   // Dodavanje marker-a
   const marker = L.marker([43.1333, 20.5100], {
       draggable: true
   }).addTo(map);

   // Kada se povuče marker, ažuriraj skrivena polja sa novim koordinatama
   marker.on('dragend', function(e) {
       const position = marker.getLatLng();
       document.getElementById('latitude').value = position.lat;
       document.getElementById('longitude').value = position.lng;

       // Traženje adrese na osnovu koordinata
       fetch(
               `https://nominatim.openstreetmap.org/reverse?format=json&lat=${position.lat}&lon=${position.lng}&addressdetails=1`)
           .then(response => response.json())
           .then(data => {
               const address = data.display_name;
               document.getElementById('address').value = address;
           });
   });

   // Kada korisnik klikne na mapu, premesti marker na novo mesto
   map.on('click', function(e) {
       const {
           lat,
           lng
       } = e.latlng;
       marker.setLatLng([lat, lng]);
       document.getElementById('latitude').value = lat;
       document.getElementById('longitude').value = lng;

       // Traženje adrese na osnovu novih koordinata
       fetch(`https://nominatim.openstreetmap.org/reverse?format=json&lat=${lat}&lon=${lng}&addressdetails=1`)
           .then(response => response.json())
           .then(data => {
               const address = data.display_name;
               document.getElementById('address').value = address;
           });
   });