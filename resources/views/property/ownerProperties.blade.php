@section('title', 'PazaRoom - Moj smeštaj')
<x-layout>
    @section('title', 'Moji stanovi - Izdati stanovi')
    <!-- Lista stanova -->
    <section class="py-16 bg-gray-100">
        <div class="max-w-7xl mx-auto px-4">
            <h2 class="text-3xl font-bold mb-8 text-center">Moji stanovi</h2>
            {{-- <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8"> --}}
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
