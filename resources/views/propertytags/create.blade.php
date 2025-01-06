<x-layout>
    <div class="container mx-auto py-8">
        <h1 class="text-2xl font-semibold mb-4 text-center">Kreiraj tag</h1>
        <form action="{{ route('property_tags_store') }}" method="POST" enctype="multipart/form-data" id="form"
            class="bg-white shadow-md rounded-lg p-6 space-y-6 md:space-y-8 border border-gray-200 mx-auto max-w-4xl">
            @csrf
            {{-- Tag  --}}
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4 items-center">
                <label for="title" class="text-sm font-medium text-gray-700">Naziv taga</label>
                <div class="md:col-span-3">
                    <input type="text" name="tag" id="tag" required
                        class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 p-2 border"
                        value="{{ old('tag')}}" />
                    @error('tag')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            <button id="submit-button" class="w-full bg-blue-600 text-white hover:bg-blue-500 rounded-md py-2 transition duration-200">Sačuvajte</button>
        </form>
        @include('partials._loader')
    </div>
    <script src="{{ asset('js/loading.js') }}"></script>
</x-layout>
