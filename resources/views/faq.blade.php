@section('title', 'PazaRoom - FAQ')
<x-layout>
    <link rel="stylesheet" href="{{ asset('css/faq.css') }}">

    <div class="faq-container">
        <h2 class="faq-title">Česta pitanja</h2>

        @php
            $faqSections = [
                'Opšta pitanja' => [
                    'Da li je registracija besplatna?' => 'Da, registracija je potpuno besplatna.',
                    'Kako da kontaktiram vlasnika smeštaja?' =>
                        'Vlasnika možete kontaktirati putem naznačenih kontaktnih informacija u oglasu.',
                    'Kako funkcioniše sistem recenzija i ocena?' =>
                        'Nakon boravka možete ostaviti recenziju i ocenu za smeštaj.',
                    'Kako mogu prijaviti neprikladan sadržaj ili korisnika?' =>
                        'Prijavu možete poslati putem kontakt stranice gde će Vam biti prosleđen odgovor putem mejla u što kraćem roku.',
                    'Kako mogu dodati smeštaj u svoje favorite?' =>
                        'Kliknite na ikonu favorita pored oglasa da biste dodali smeštaj u svoju listu favorita.',
                ],
                'Korisnički nalozi' => [
                    'Kako mogu izmeniti svoje podatke?' => 'Podatke možete izmeniti u sekciji "Moj profil".',
                    'Kako da izbrišem svoj nalog?' => 'Brisanje naloga možete zatražiti putem kontakt stranice.',
                ],
                'Vlasnici smeštaja' => [
                    'Kako da postavim svoj smeštaj na PazaRoom?' =>
                        'Registrujte se kao vlasnik i odaberite sekciju "Dodaj smeštaj" te popuniti sva polja u formi.',
                    'Kako da uređujem ili brišem svoje oglase?' =>
                        'Oglase možete uređivati ili brisati u sekciji "Moji oglasi".',
                    'Kako funkcioniše sistem verifikacije vlasnika?' =>
                        'Administrator može odobriti ili odbiti zahtev za postavljanje oglasa u zavisnosti od ispravnosti prosleđenog dokumenta o vlasništvu objekta.',
                    'Mogu li postaviti više od jednog smeštaja?' =>
                        'Da, možete postaviti više smeštaja, svaki sa posebnim oglasom.',
                ],
                'Tehnička podrška' => [
                    'Stranica se ne učitava ispravno, šta da radim?' =>
                        'Pokušajte osvežiti stranicu ili obrisati keš memoriju.',
                    'Šta da radim ako ne mogu da pronađem odgovarajući smeštaj?' =>
                        'Proverite da li ste koristili odgovarajuće filtre prilikom pretrage. Takođe, možete se obratiti vlasnicima direktno putem kontakt informacija u oglasima.',
                ],
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
