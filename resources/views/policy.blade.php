@section('title', 'Politika Privatnosti')
<x-layout>
    <div class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100 py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-4xl mx-auto bg-white rounded-2xl shadow-lg overflow-hidden">
            <div class="px-6 py-8 sm:px-12">
                <h1 class="text-3xl font-bold text-gray-900 mb-8 border-b pb-4">Politika Privatnosti</h1>

                <div class="space-y-6 text-gray-700">
                    <section class="space-y-4">
                        <h2 class="text-2xl font-semibold text-gray-800">1. Uvod</h2>
                        <p class="leading-relaxed">
                            Dobrodošli na našu platformu za izdavanje smeštaja studentima. Vaša privatnost nam je
                            izuzetno važna i posvećeni smo zaštiti vaših ličnih podataka.
                        </p>
                    </section>

                    <section class="space-y-4">
                        <h2 class="text-2xl font-semibold text-gray-800">2. Koje podatke prikupljamo</h2>
                        <ul class="list-disc pl-6 space-y-2">
                            <li>Osnovne podatke (ime, prezime, email adresa)</li>
                            <li>Kontakt informacije</li>
                            <li>Studentski status</li>
                            <li>Preference za smeštaj</li>
                        </ul>
                    </section>

                    <section class="space-y-4">
                        <h2 class="text-2xl font-semibold text-gray-800">3. Kako koristimo vaše podatke</h2>
                        <p class="leading-relaxed">
                            Vaše podatke koristimo isključivo u svrhu:
                        </p>
                        <ul class="list-disc pl-6 space-y-2">
                            <li>Povezivanja studenata sa odgovarajućim smeštajem</li>
                            <li>Unapređenja korisničkog iskustva</li>
                            <li>Komunikacije vezane za iznajmljivanje</li>
                        </ul>
                    </section>

                    <section class="space-y-4">
                        <h2 class="text-2xl font-semibold text-gray-800">4. Zaštita podataka</h2>
                        <p class="leading-relaxed">
                            Primenjujemo najsavremenije mere zaštite kako bismo osigurali bezbednost vaših podataka.
                            Vaši podaci se čuvaju na sigurnim serverima i pristup njima imaju samo ovlašćena lica.
                        </p>
                    </section>

                    <section class="space-y-4">
                        <h2 class="text-2xl font-semibold text-gray-800">5. Vaša prava</h2>
                        <p class="leading-relaxed">
                            Imate pravo da:
                        </p>
                        <ul class="list-disc pl-6 space-y-2">
                            <li>Zatražite uvid u svoje podatke</li>
                            <li>Ispravite netačne podatke</li>
                            <li>Zatražite brisanje podataka</li>
                            <li>Povučete saglasnost za obradu podataka</li>
                        </ul>
                    </section>
                </div>

                <div class="mt-12 pt-8 border-t">
                    <p class="text-sm text-gray-500">
                        Poslednje ažuriranje: {{ now()->toFormattedDateString() }}.
                    </p>
                </div>
            </div>
        </div>
    </div>
</x-layout>
