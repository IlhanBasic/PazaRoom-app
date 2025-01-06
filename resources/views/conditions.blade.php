@section('title', 'Uslovi korišćenja')
<x-layout>
    <div class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100 py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-4xl mx-auto bg-white rounded-2xl shadow-lg overflow-hidden">
            <div class="px-6 py-8 sm:px-12">
                <h1 class="text-3xl font-bold text-gray-900 mb-8 border-b pb-4">Uslovi Korišćenja</h1>

                <div class="space-y-6 text-gray-700">
                    <section class="space-y-4">
                        <h2 class="text-2xl font-semibold text-gray-800">1. Opšte odredbe</h2>
                        <p class="leading-relaxed">
                            Korišćenjem naše platforme prihvatate sve navedene uslove korišćenja. Molimo vas da ih
                            pažljivo pročitate pre nego što počnete sa korišćenjem naših usluga.
                        </p>
                    </section>

                    <section class="space-y-4">
                        <h2 class="text-2xl font-semibold text-gray-800">2. Usluge</h2>
                        <p class="leading-relaxed">
                            Naša platforma omogućava:
                        </p>
                        <ul class="list-disc pl-6 space-y-2">
                            <li>Pretragu smeštaja za studente</li>
                            <li>Povezivanje stanodavaca i studenata</li>
                            <li>Objavu oglasa za izdavanje</li>
                            <li>Komunikaciju između korisnika</li>
                        </ul>
                    </section>

                    <section class="space-y-4">
                        <h2 class="text-2xl font-semibold text-gray-800">3. Pravila korišćenja</h2>
                        <p class="leading-relaxed">
                            Korisnici se obavezuju da će:
                        </p>
                        <ul class="list-disc pl-6 space-y-2">
                            <li>Pružati tačne i istinite informacije</li>
                            <li>Poštovati prava drugih korisnika</li>
                            <li>Ne zloupotrebljavati platformu</li>
                            <li>Čuvati svoje pristupne podatke</li>
                        </ul>
                    </section>

                    <section class="space-y-4">
                        <h2 class="text-2xl font-semibold text-gray-800">4. Odgovornost</h2>
                        <p class="leading-relaxed">
                            Ne snosimo odgovornost za:
                        </p>
                        <ul class="list-disc pl-6 space-y-2">
                            <li>Tačnost informacija koje objavljuju korisnici</li>
                            <li>Kvalitet smeštaja</li>
                            <li>Sporove između korisnika</li>
                        </ul>
                    </section>

                    <section class="space-y-4">
                        <h2 class="text-2xl font-semibold text-gray-800">5. Prekid usluga</h2>
                        <p class="leading-relaxed">
                            Zadržavamo pravo da:
                        </p>
                        <ul class="list-disc pl-6 space-y-2">
                            <li>Suspendujemo naloge koji krše pravila</li>
                            <li>Izmenimo ili ukinemo usluge</li>
                            <li>Ažuriramo uslove korišćenja</li>
                        </ul>
                    </section>

                    <section class="space-y-4 mt-8">
                        <h2 class="text-2xl font-semibold text-gray-800">6. Rešavanje sporova</h2>
                        <p class="leading-relaxed">
                            Svi sporovi će se rešavati u skladu sa važećim zakonima Republike Srbije, pred nadležnim
                            sudom.
                        </p>
                    </section>
                </div>

                <div class="mt-12 pt-8 border-t">
                    <p class="text-sm text-gray-500">
                        Poslednje ažuriranje: {{now()->toFormattedDateString()}}.
                    </p>
                </div>
            </div>
        </div>
    </div>
</x-layout>
