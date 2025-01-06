<x-layout>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="sm:flex sm:items-center sm:justify-between">
            <h1 class="text-2xl font-bold text-gray-900">Zahtevi za iznajmljivanje</h1>
            <span class="hidden sm:block text-sm text-gray-500">Ukupno zahteva: {{ $reservations->total() }}</span>
        </div>

        @if ($reservations->count() > 0)
            <div class="mt-8 flex flex-col">
                <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
                        <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 rounded-lg">
                            <table class="min-w-full divide-y divide-gray-300">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col"
                                            class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">
                                            Student</th>
                                        <th scope="col"
                                            class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Smeštaj
                                        </th>
                                        <th scope="col"
                                            class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Datumi
                                        </th>
                                        <th scope="col"
                                            class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Status
                                        </th>
                                        <th scope="col"
                                            class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Akcije
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200 bg-white">
                                    @foreach ($reservations as $reservation)
                                        <tr class="hover:bg-gray-50">
                                            <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm sm:pl-6">
                                                <div class="flex items-center">
                                                    <div class="h-10 w-10 flex-shrink-0">
                                                        <span
                                                            class="inline-flex h-10 w-10 items-center justify-center rounded-full bg-gray-500">
                                                            <span class="font-medium leading-none text-white">
                                                                {{ substr($reservation->user->first_name, 0, 1) }}
                                                            </span>
                                                        </span>
                                                    </div>
                                                    <div class="ml-4">
                                                        <div class="font-medium text-gray-900">
                                                            {{ $reservation->user->first_name . ' ' . $reservation->user->last_name }}
                                                        </div>
                                                        <div class="text-gray-500">{{ $reservation->user->email }}</div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                                <div class="font-medium text-gray-900">
                                                    {{ Str::limit($reservation->property->title, 30) }}</div>
                                                <div class="text-gray-500">
                                                    {{ Str::limit($reservation->property->address, 30) }}</div>
                                            </td>
                                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                                <div class="font-medium text-gray-900">
                                                    {{ \Carbon\Carbon::parse($reservation->start_date)->format('d.m.Y') }}
                                                </div>
                                                <div class="text-gray-500">
                                                    {{ \Carbon\Carbon::parse($reservation->end_date)->format('d.m.Y') }}
                                                </div>
                                            </td>
                                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                                @php
                                                    $statusClasses = match ($reservation->status) {
                                                        'Pending' => 'bg-yellow-100 text-yellow-800',
                                                        'Confirmed' => 'bg-green-100 text-green-800',
                                                        'Cancelled' => 'bg-red-100 text-red-800',
                                                        default => 'bg-gray-100 text-gray-800',
                                                    };

                                                    $statusLabels = [
                                                        'Pending' => 'Na čekanju',
                                                        'Confirmed' => 'Odobreno',
                                                        'Cancelled' => 'Odbijeno',
                                                    ];

                                                    $status = $statusLabels[$reservation->status] ?? 'Pending...';
                                                @endphp
                                                <span
                                                    class="px-3 py-1 inline-flex text-sm font-medium rounded-full {{ $statusClasses }}">
                                                    {{ $status }}
                                                </span>
                                            </td>
                                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                                @if ($reservation->status === 'Pending')
                                                    <div class="flex space-x-2">
                                                        <form id="form-confirm" action="{{ route('reservation_update') }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('PATCH')
                                                            <input type="hidden" name="status" value="Confirmed">
                                                            <input type="hidden" name="property_id"
                                                                value="{{ $reservation->property_id }}">
                                                            <button type="submit"
                                                                class="inline-flex items-center px-3 py-1.5 bg-green-600 text-white text-sm font-medium rounded-md hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition-colors">
                                                                <svg class="h-4 w-4 mr-1.5" fill="none"
                                                                    stroke="currentColor" viewBox="0 0 24 24">
                                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                                        stroke-width="2" d="M5 13l4 4L19 7" />
                                                                </svg>
                                                                Prihvati
                                                            </button>
                                                        </form>

                                                        <form id="form-cancel" action="{{ route('reservation_update') }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('PATCH')
                                                            <input type="hidden" name="status" value="Cancelled">
                                                            <input type="hidden" name="property_id"
                                                                value="{{ $reservation->property_id }}">
                                                            <button type="submit"
                                                                class="inline-flex items-center px-3 py-1.5 bg-red-600 text-white text-sm font-medium rounded-md hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-colors">
                                                                <svg class="h-4 w-4 mr-1.5" fill="none"
                                                                    stroke="currentColor" viewBox="0 0 24 24">
                                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                                        stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                                </svg>
                                                                Odbij
                                                            </button>
                                                        </form>
                                                    </div>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-6">
                {{ $reservations->links() }}
            </div>
        @else
            <div class="mt-8 text-center">
                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                </svg>
                <h3 class="mt-2 text-sm font-medium text-gray-900">Nema rezervacija</h3>
                <p class="mt-1 text-sm text-gray-500">Ne postoji ni jedna rezervacija u sistemu.</p>
            </div>
        @endif
    </div>
</x-layout>
