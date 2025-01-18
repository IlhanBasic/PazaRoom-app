<x-layout>
    <link rel="stylesheet" href="{{ asset('css/faq.css') }}">

    <div class="faq-container">
        <h2 class="faq-title">Česta pitanja</h2>

        @php
            $faqSections = [
                'Opšta pitanja' => [
                    'Kako mogu rezervisati smeštaj?' => 'Rezervaciju možete izvršiti putem naše platforme nakon registracije.',
                    'Da li je registracija besplatna?' => 'Da, registracija je potpuno besplatna.',
                    'Kako da kontaktiram vlasnika smeštaja?' => 'Vlasnika možete kontaktirati putem poruka na platformi.',
                    'Kako funkcioniše sistem recenzija i ocena?' => 'Nakon boravka možete ostaviti recenziju i ocenu za smeštaj.',
                    'Kako mogu prijaviti neprikladan sadržaj ili korisnika?' => 'Prijavu možete poslati putem opcije "Prijavi" na profilu korisnika ili oglasa.'
                ],
                'Korisnički nalozi' => [
                    'Zaboravio/la sam lozinku, kako da je resetujem?' => 'Možete resetovati lozinku klikom na "Zaboravljena lozinka".',
                    'Kako mogu izmeniti svoje podatke?' => 'Podatke možete izmeniti u sekciji "Moj profil".',
                    'Kako da izbrišem svoj nalog?' => 'Brisanje naloga možete zatražiti putem korisničke podrške.'
                ],
                'Vlasnici smeštaja' => [
                    'Kako da postavim svoj smeštaj na PazaRoom?' => 'Registrujte se kao vlasnik i pratite uputstva za dodavanje oglasa.',
                    'Kako da uređujem ili brišem svoje oglase?' => 'Oglase možete uređivati ili brisati u sekciji "Moji oglasi".',
                    'Kako funkcioniše sistem verifikacije vlasnika?' => 'Verifikacija uključuje potvrdu identiteta i vlasništva nad smeštajem.'
                ],
                'Tehnička podrška' => [
                    'Stranica se ne učitava ispravno, šta da radim?' => 'Pokušajte osvežiti stranicu ili obrisati keš memoriju.',
                    'Ne mogu da pošaljem poruku vlasniku, kako da rešim problem?' => 'Proverite internet konekciju i pokušajte ponovo.'
                ]
            ];
        @endphp

        @foreach ($faqSections as $section => $questions)
            <h3 class="faq-question-text">{{ $section }}</h3>
            @foreach ($questions as $question => $answer)
                <div class="faq-item">
                    <button class="faq-question">
                        <span>{{ $question }}</span>
                        <span class="arrow">▼</span>
                    </button>
                    <div class="faq-answer">{{ $answer }}</div>
                </div>
            @endforeach
        @endforeach
    </div>

    <script>
        document.querySelectorAll('.faq-question').forEach(button => {
            button.addEventListener('click', () => {
                const item = button.parentNode;
                item.classList.toggle('active');
            });
        });
    </script>
</x-layout>
