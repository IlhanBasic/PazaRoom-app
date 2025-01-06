@section('title', 'PazaRoom - Početna')
<x-layout>
    @section('title', 'Početna - Izdavanje Stanova')
    @include('partials._hero')
    <!-- Hero sekcija -->
    <section class="bg-blue-600 text-white py-20">
        <div class="max-w-7xl mx-auto px-4 text-center">
            <h1 class="text-4xl font-bold mb-4">Pronađite svoj idealan stan</h1>
            @include('partials._search')
        </div>
    </section>
    <!-- Filter sekcija -->
    <section class="bg-gray-100 py-16">
        <div class="max-w-7xl mx-auto px-4">
            <h2 class="text-4xl font-bold text-center mb-8">Primenite filtere</h2>
            <div class="flex flex-col lg:flex-row justify-center items-center gap-4">
                @include('partials._filter')
            </div>
        </div>
    </section>
    <!-- Lista stanova -->
    <section class="py-16 bg-gray-100">
        <div class="max-w-7xl mx-auto px-4">
            <h2 class="text-3xl font-bold mb-8 text-center">Naši stanovi</h2>
            <!-- Sortiranje -->
            <section>
                <div class="max-w-7xl mx-auto px-4">
                    <div class="flex justify-center items-center">
                        <div class="m-1/2">
                            @include('partials._sort')
                        </div>
                    </div>
                </div>
            </section>
            <div class="grid grid-cols-1 gap-8">
                @foreach ($properties as $stan)
                    <x-property-card :property="$stan" />
                @endforeach
                @if ($properties->isEmpty())
                    <p class="text-center text-gray-600">Nema stanova za prikaz.</p>
                @endif
                <div class="mx-4 my-8">
                    {{ $properties->links() }}
                </div>
            </div>
        </div>
    </section>
</x-layout>
