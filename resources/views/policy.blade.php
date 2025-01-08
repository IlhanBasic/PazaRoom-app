@section('title', 'Politika Privatnosti')
<x-layout>
    <div class="privacy-policy-container">
        <div class="content-wrapper">
            <div class="content-inner">
                <h1 class="title">Politika Privatnosti</h1>

                <div class="sections">
                    <section class="section">
                        <h2 class="section-title">1. Uvod</h2>
                        <p class="section-content">
                            Dobrodošli na našu platformu za izdavanje smeštaja studentima. Vaša privatnost nam je
                            izuzetno važna i posvećeni smo zaštiti vaših ličnih podataka.
                        </p>
                    </section>

                    <section class="section">
                        <h2 class="section-title">2. Koje podatke prikupljamo</h2>
                        <ul class="list">
                            <li>Osnovne podatke (ime, prezime, email adresa)</li>
                            <li>Kontakt informacije</li>
                            <li>Studentski status</li>
                            <li>Preference za smeštaj</li>
                        </ul>
                    </section>

                    <section class="section">
                        <h2 class="section-title">3. Kako koristimo vaše podatke</h2>
                        <p class="section-content">
                            Vaše podatke koristimo isključivo u svrhu:
                        </p>
                        <ul class="list">
                            <li>Povezivanja studenata sa odgovarajućim smeštajem</li>
                            <li>Unapređenja korisničkog iskustva</li>
                            <li>Komunikacije vezane za iznajmljivanje</li>
                        </ul>
                    </section>

                    <section class="section">
                        <h2 class="section-title">4. Zaštita podataka</h2>
                        <p class="section-content">
                            Primenjujemo najsavremenije mere zaštite kako bismo osigurali bezbednost vaših podataka.
                            Vaši podaci se čuvaju na sigurnim serverima i pristup njima imaju samo ovlašćena lica.
                        </p>
                    </section>

                    <section class="section">
                        <h2 class="section-title">5. Vaša prava</h2>
                        <p class="section-content">
                            Imate pravo da:
                        </p>
                        <ul class="list">
                            <li>Zatražite uvid u svoje podatke</li>
                            <li>Ispravite netačne podatke</li>
                            <li>Zatražite brisanje podataka</li>
                            <li>Povučete saglasnost za obradu podataka</li>
                        </ul>
                    </section>
                </div>

                <div class="last-updated">
                    <p class="last-updated-text">
                        Poslednje ažuriranje: {{ now()->toFormattedDateString() }}.
                    </p>
                </div>
            </div>
        </div>
    </div>
</x-layout>
<link rel="stylesheet" href="{{ asset('css/policy.css') }}">