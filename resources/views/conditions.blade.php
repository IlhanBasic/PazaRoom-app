@section('title', 'Uslovi korišćenja')
<x-layout>
    <div class="uslovi-container">
        <div class="uslovi-box">
            <div class="uslovi-content">
                <h1 class="uslovi-title">Uslovi Korišćenja</h1>

                <div class="uslovi-sections">
                    <section class="uslovi-section">
                        <h2 class="uslovi-subtitle">1. Opšte odredbe</h2>
                        <p class="uslovi-text">
                            Korišćenjem naše platforme prihvatate sve navedene uslove korišćenja. Molimo vas da ih
                            pažljivo pročitate pre nego što počnete sa korišćenjem naših usluga.
                        </p>
                    </section>

                    <section class="uslovi-section">
                        <h2 class="uslovi-subtitle">2. Usluge</h2>
                        <p class="uslovi-text">
                            Naša platforma omogućava:
                        </p>
                        <ul class="uslovi-list">
                            <li>Pretragu smeštaja za studente</li>
                            <li>Povezivanje stanodavaca i studenata</li>
                            <li>Objavu oglasa za izdavanje</li>
                        </ul>
                    </section>

                    <section class="uslovi-section">
                        <h2 class="uslovi-subtitle">3. Pravila korišćenja</h2>
                        <p class="uslovi-text">
                            Korisnici se obavezuju da će:
                        </p>
                        <ul class="uslovi-list">
                            <li>Pružati tačne i istinite informacije</li>
                            <li>Poštovati prava drugih korisnika</li>
                            <li>Ne zloupotrebljavati platformu</li>
                            <li>Čuvati svoje pristupne podatke</li>
                        </ul>
                    </section>

                    <section class="uslovi-section">
                        <h2 class="uslovi-subtitle">4. Odgovornost</h2>
                        <p class="uslovi-text">
                            Ne snosimo odgovornost za:
                        </p>
                        <ul class="uslovi-list">
                            <li>Tačnost informacija koje objavljuju korisnici</li>
                            <li>Kvalitet smeštaja</li>
                            <li>Sporove između korisnika</li>
                        </ul>
                    </section>

                    <section class="uslovi-section">
                        <h2 class="uslovi-subtitle">5. Prekid usluga</h2>
                        <p class="uslovi-text">
                            Zadržavamo pravo da:
                        </p>
                        <ul class="uslovi-list">
                            <li>Suspendujemo naloge koji krše pravila</li>
                            <li>Izmenimo ili ukinemo usluge</li>
                            <li>Ažuriramo uslove korišćenja</li>
                        </ul>
                    </section>

                    <section class="uslovi-section uslovi-last-section">
                        <h2 class="uslovi-subtitle">6. Rešavanje sporova</h2>
                        <p class="uslovi-text">
                            Svi sporovi će se rešavati u skladu sa važećim zakonima Republike Srbije, pred nadležnim
                            sudom.
                        </p>
                    </section>
                </div>

                <div class="uslovi-footer">
                    <p class="uslovi-footer-text">
                        Poslednje ažuriranje: {{now()->toFormattedDateString()}}.
                    </p>
                </div>
            </div>
        </div>
    </div>
</x-layout>
<link rel="stylesheet" href="{{ asset('css/conditions.css') }}">