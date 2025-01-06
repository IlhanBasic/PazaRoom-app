<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        [x-cloak] {
            display: none !important;
        }

        .sidebar-link.active {
            background-color: rgba(255, 255, 255, 0.1);
            border-left: 4px solid #60A5FA;
        }

        .table-container {
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }

        .table-container table {
            min-width: 100%;
        }

        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
                transition: transform 0.3s ease-in-out;
            }

            .sidebar.open {
                transform: translateX(0);
            }
        }
    </style>
</head>

<body class="bg-gray-100">
    <x-flash-message />
    <div x-data="{
        sidebarOpen: false,
        currentTab: 'users',
        toggleSidebar() { this.sidebarOpen = !this.sidebarOpen },
        setCurrentTab(tab) { this.currentTab = tab }
    }" class="min-h-screen">
        <!-- Mobile Menu Button -->
        <div class="lg:hidden fixed top-4 left-4 z-50">
            <button @click="toggleSidebar" class="p-2 rounded-md bg-gray-800 text-white">
                <i class="fas fa-bars"></i>
            </button>
        </div>

        <!-- Sidebar -->
        <div :class="{ 'open': sidebarOpen }"
            class="sidebar fixed top-0 left-0 h-full w-64 bg-gray-800 text-white z-40 lg:translate-x-0">
            <div class="p-6">
                <h4 class="text-xl font-bold mb-8">Admin Dashboard</h4>
                <nav class="space-y-2">
                    <a @click="setCurrentTab('acceptProperty')" :class="{ 'active': currentTab === 'acceptProperty' }"
                        class="sidebar-link flex items-center px-4 py-3 text-gray-300 hover:bg-gray-700 rounded transition-colors cursor-pointer">
                        <i class="fa-solid fa-check mr-3"></i>
                        <span>Proveri nekretninu</span>
                    </a>
                    <a @click="setCurrentTab('users')" :class="{ 'active': currentTab === 'users' }"
                        class="sidebar-link flex items-center px-4 py-3 text-gray-300 hover:bg-gray-700 rounded transition-colors cursor-pointer">
                        <i class="fas fa-users mr-3"></i>
                        <span>Korisnici</span>
                    </a>
                    <a @click="setCurrentTab('roles')" :class="{ 'active': currentTab === 'roles' }"
                        class="sidebar-link flex items-center px-4 py-3 text-gray-300 hover:bg-gray-700 rounded transition-colors cursor-pointer">
                        <i class="fa-solid fa-list mr-3"></i>
                        <span> Vrste korisnika</span>
                    </a>
                    <a @click="setCurrentTab('properties')" :class="{ 'active': currentTab === 'properties' }"
                        class="sidebar-link flex items-center px-4 py-3 text-gray-300 hover:bg-gray-700 rounded transition-colors cursor-pointer">
                        <i class="fas fa-building mr-3"></i>
                        <span>Nekretnine</span>
                    </a>
                    <a @click="setCurrentTab('propertyTags')" :class="{ 'active': currentTab === 'propertyTags' }"
                        class="sidebar-link flex items-center px-4 py-3 text-gray-300 hover:bg-gray-700 rounded transition-colors cursor-pointer">
                        <i class="fas fa-tags mr-3"></i>
                        <span>Tagovi</span>
                    </a>
                    <a @click="setCurrentTab('reviews')" :class="{ 'active': currentTab === 'reviews' }"
                        class="sidebar-link flex items-center px-4 py-3 text-gray-300 hover:bg-gray-700 rounded transition-colors cursor-pointer">
                        <i class="fas fa-tags mr-3"></i>
                        <span>Recenzije</span>
                    </a>
                    <a href="/"
                        class="sidebar-link bg-blue-500 flex items-center px-4 py-3 text-gray-300 hover:bg-gray-700 rounded transition-colors cursor-pointer">
                        <i class="fas fa-home mr-3"></i>
                        <span>Nazad na početnu</span>
                    </a>
                </nav>
            </div>
        </div>

        <!-- Main Content -->
        <div class="lg:ml-64 p-8">
            <div class="max-w-7xl mx-auto">
                <h2 class="text-3xl font-bold text-gray-800 mb-8">Dashboard</h2>
                <!-- Accept Property -->
                <div x-show="currentTab === 'acceptProperty'" x-cloak class="bg-white rounded-lg shadow-md">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h3 class="text-xl font-semibold text-gray-800">Proveri nekretninu</h3>
                    </div>
                    <div class="table-container">
                        <table class="w-full">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        ID</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Ime i Prezime</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Detaljnij prikaz nekretnine</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Dokaz o vlasnistvu</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Akcije</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($properties->where('status', 'Pending') as $property)
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ $property->id }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ $property->owner->first_name }} {{ $property->owner->last_name }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"><a
                                                class="text-blue-600"
                                                href="{{ route('property_show', $property->id) }}">{{ Str::limit(route('property_show', $property->id), 30) }}</a>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"><a
                                                href="storage/{{ $property->ownership_proof }}"
                                                class="text-blue-600">{{ Str::limit($property->ownership_proof, 30) }}</a>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2">
                                            <form action="{{ route('property_accept', $property->id) }}" method="POST"
                                                class="accept-property-form inline">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="text-green-600 hover:text-green-900">
                                                    <i class="fa-solid fa-check"></i>
                                                </button>
                                            </form>
                                            <form action="{{ route('property_decline', $property->id) }}" method="POST"
                                                class="reject-property-form inline">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="text-red-600 hover:text-red-900">
                                                    <i class="fa-solid fa-ban"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- Roles Table -->
                <div x-show="currentTab === 'roles'" x-cloak class="bg-white rounded-lg shadow-md">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h3 class="text-xl font-semibold text-gray-800">Vrste korisnika</h3>
                        <a href="{{ route('role_create') }}" class="text-blue-600 hover:text-blue-900 mt-4">
                            <i class="fas fa-plus"></i> Dodaj vrstu
                        </a>
                    </div>
                    <div class="table-container">
                        <table class="w-full">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        ID</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Naziv</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Akcije</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($roles as $role)
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ $role->id }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ $role->name }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2">
                                            <a href="{{ route('role_edit', $role->id) }}"
                                                class="text-blue-600 hover:text-blue-900">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('role_delete', $role->id) }}" method="POST"
                                                id="delete-form-{{ $role->id }}"
                                                class="delete-property-tag-form inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" id="submit-button"
                                                    class="text-red-600 hover:text-red-900">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- Users Table -->
                <div x-show="currentTab === 'users'" x-cloak class="bg-white rounded-lg shadow-md">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h3 class="text-xl font-semibold text-gray-800">Korisnici</h3>
                        <a href="{{ route('register') }}" class="text-blue-600 hover:text-blue-900 mt-4">
                            <i class="fas fa-add"></i> Dodaj korisnika
                        </a>
                    </div>
                    <div class="table-container">
                        <table class="w-full">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        ID</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Ime</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Prezime</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Email</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Telefon</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Uloga</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Akcije</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($users as $user)
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ $user->id }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ $user->first_name }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ $user->last_name }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ $user->email }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ $user->phone_number }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ $user->role->name }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2">
                                            <form action="{{ route('delete_user', $user->id) }}" method="POST" id="delete-form-{{ $user->id }}"
                                                class="delete-property-tag-form inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" id="submit-button"
                                                    class="text-red-600 hover:text-red-900">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Properties Table -->
                <div x-show="currentTab === 'properties'" x-cloak class="bg-white rounded-lg shadow-md">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h3 class="text-xl font-semibold text-gray-800">Nekretnine</h3>
                    </div>
                    <div class="table-container">
                        <table class="w-full">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        ID</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Naslov</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Adresa</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Cena</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Vlasnik</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        m²</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Tip</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Vrsta</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Grejanje</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Status</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Akcije</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($properties as $property)
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ $property->id }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ $property->title }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            @php
                                                $addressArray = explode(',', $property->address);
                                            @endphp
                                            {{ $addressArray[0] ?? '' }}, {{ $addressArray[1] ?? '' }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ $property->rent_price }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ $property->owner->first_name }} {{ $property->owner->last_name }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ $property->area }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ $property->type }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ $property->property_type }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ $property->heating }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            <span
                                                class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                                {{ $property->status === 'active' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                                {{ $property->status }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2">
                                            <a href="{{ route('property_edit', $property->id) }}"
                                                class="text-blue-600 hover:text-blue-900">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('property_delete', $property->id) }}"
                                                id="delete-form-{{ $property->id }}"
                                                method="POST" class="delete-property-tag-form inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" id="submit-button"
                                                    class="text-red-600 hover:text-red-900">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Property Tags Table -->
                <div x-show="currentTab === 'propertyTags'" x-cloak class="bg-white rounded-lg shadow-md">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h3 class="text-xl font-semibold text-gray-800">Tagovi nekretnina</h3>
                        <a href="{{ route('property_tags_create') }}" class="text-blue-600 hover:text-blue-900 mt-4">
                            <i class="fas fa-plus"></i> Dodaj tag
                        </a>
                    </div>
                    <div class="table-container">
                        <table class="w-full">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        ID</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Tag</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Akcije</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($propertyTags as $propertyTag)
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ $propertyTag->id }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ $propertyTag->tag }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2">
                                            <a href="{{ route('property_tag_edit', $propertyTag->id) }}"
                                                class="text-blue-600 hover:text-blue-900">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('property_tag_delete', $propertyTag->id) }}"
                                                id="delete-form-{{ $propertyTag->id }}"
                                                method="POST" class="delete-property-tag-form inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" id="submit-button"
                                                    class="text-red-600 hover:text-red-900">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- Reviews Table -->
                <div x-show="currentTab === 'reviews'" x-cloak class="bg-white rounded-lg shadow-md">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h3 class="text-xl font-semibold text-gray-800">Recenzije</h3>
                    </div>
                    <div class="table-container">
                        <table class="w-full">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        ID</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Id nekretnine</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Kreator</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Sadržaj</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Akcije</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($reviews as $review)
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ $review->id }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ $review->property_id }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ $review->user->first_name }} {{ $review->user->last_name }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ $review->comment }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2">
                                            <form action="{{ route('review_delete', $review->id) }}" method="POST"
                                                id="delete-form-{{ $review->id }}"
                                                class="delete-property-tag-form inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" id="submit-button"
                                                    class="text-red-600 hover:text-red-900">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="{{ asset('js/deleteButton.js') }}"></script>
</body>

</html>
