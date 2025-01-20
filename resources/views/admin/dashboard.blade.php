<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/admindashboard.css') }}">
</head>

<body>
    <x-flash-message />
    <div x-data="{
        sidebarOpen: false,
        currentTab: 'users',
        toggleSidebar() { this.sidebarOpen = !this.sidebarOpen },
        setCurrentTab(tab) { this.currentTab = tab }
    }" class="dashboard">
        <!-- Mobile Menu Button -->
        <div class="mobile-menu-btn">
            <button @click="toggleSidebar">
                <i class="fas fa-bars"></i>
            </button>
        </div>

        <!-- Sidebar -->
        <div :class="{ 'open': sidebarOpen }" class="sidebar">
            <div class="sidebar-content">
                <h4></h4>
                <nav>
                    <a @click="setCurrentTab('acceptProperty')" :class="{ 'active': currentTab === 'acceptProperty' }"
                        class="sidebar-link">
                        <i class="fa-solid fa-check"></i>
                        <span>Proveri nekretninu</span>
                    </a>
                    <a @click="setCurrentTab('contactMessages')" :class="{ 'active': currentTab === 'contactMessages' }"
                        class="sidebar-link">
                        <i class="fa-solid fa-message"></i>
                        <span>Inbox</span>
                    </a>
                    <a @click="setCurrentTab('users')" :class="{ 'active': currentTab === 'users' }"
                        class="sidebar-link">
                        <i class="fas fa-users"></i>
                        <span>Korisnici</span>
                    </a>
                    <a @click="setCurrentTab('roles')" :class="{ 'active': currentTab === 'roles' }"
                        class="sidebar-link">
                        <i class="fa-solid fa-list"></i>
                        <span>Vrste korisnika</span>
                    </a>
                    <a @click="setCurrentTab('properties')" :class="{ 'active': currentTab === 'properties' }"
                        class="sidebar-link">
                        <i class="fas fa-building"></i>
                        <span>Nekretnine</span>
                    </a>
                    <a @click="setCurrentTab('propertyTags')" :class="{ 'active': currentTab === 'propertyTags' }"
                        class="sidebar-link">
                        <i class="fas fa-tags"></i>
                        <span>Tagovi</span>
                    </a>
                    <a @click="setCurrentTab('reviews')" :class="{ 'active': currentTab === 'reviews' }"
                        class="sidebar-link">
                        <i class="fas fa-tags"></i>
                        <span>Recenzije</span>
                    </a>
                    <a href="/" class="sidebar-link home-link">
                        <i class="fas fa-home"></i>
                        <span>Nazad na početnu</span>
                    </a>
                </nav>
            </div>
        </div>

        <!-- Main Content -->
        <div class="main-content">
            <div class="container">
                <h2>Dashboard</h2>

                <!-- Accept Property -->
                <div x-show="currentTab === 'acceptProperty'" x-cloak class="card">
                    <div class="card-header">
                        <h3>Proveri nekretninu</h3>
                    </div>
                    <div class="table-container">
                        <table>
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Ime i Prezime</th>
                                    <th>Detaljnij prikaz nekretnine</th>
                                    <th>Dokaz o vlasnistvu</th>
                                    <th>Akcije</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($properties->where('status', 'Pending') as $property)
                                    <tr>
                                        <td>{{ $property->id }}</td>
                                        <td>{{ $property->owner->first_name }} {{ $property->owner->last_name }}</td>
                                        <td><a href="{{ route('property_show', $property->id) }}">
                                                {{ Str::limit(route('property_show', $property->id), 30) }}</a>
                                        </td>
                                        <td><a href="{{ $property->ownership_proof }}">
                                                {{ Str::limit($property->ownership_proof, 30) }}</a>
                                        </td>
                                        <td class="actions">
                                            <form action="{{ route('property_accept', $property->id) }}" method="POST"
                                                class="accept-property-form">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="btn-accept">
                                                    <i class="fa-solid fa-check"></i>
                                                </button>
                                            </form>
                                            <form action="{{ route('property_decline', $property->id) }}" method="POST"
                                                class="reject-property-form">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="btn-reject">
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
                <!-- Contact Messages -->
                <div x-show="currentTab === 'contactMessages'" x-cloak class="card">
                    <div class="card-header">
                        <h3>Inbox poruke</h3>
                    </div>
                    <div class="table-container">
                        <table>
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>ID korisnika</th>
                                    <th>Ime i Prezime</th>
                                    <th>Email</th>
                                    <th>Naslov</th>
                                    <th>Tekst</th>
                                    <th>Akcije</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($messages as $message)
                                    <tr>
                                        <td>{{ $message->id }}</td>
                                        <td>{{ $message->user_id ?? 'Neregistrovan' }}</td>
                                        <td>{{ $message->name }}</td>
                                        <td>{{ $message->email }}</td>
                                        <td>{{ $message->subject }}</td>
                                        <td>{{ Str::limit($message->message, 30) }}</td>
                                        <td class="actions">
                                            <a href="{{ route('contact_show', $message->id) }}" class="btn-show">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Roles Table -->
                <div x-show="currentTab === 'roles'" x-cloak class="card">
                    <div class="card-header">
                        <h3>Vrste korisnika</h3>
                        <a href="{{ route('role_create') }}" class="btn-add">
                            <i class="fas fa-plus"></i> Dodaj vrstu
                        </a>
                    </div>
                    <div class="table-container">
                        <table>
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Naziv</th>
                                    <th>Akcije</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($roles as $role)
                                    <tr>
                                        <td>{{ $role->id }}</td>
                                        <td>{{ $role->name }}</td>
                                        <td class="actions">
                                            <a href="{{ route('role_edit', $role->id) }}" class="btn-edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('role_delete', $role->id) }}" method="POST"
                                                id="delete-form-{{ $role->id }}" class="delete-property-tag-form">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn-delete">
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
                <div x-show="currentTab === 'users'" x-cloak class="card">
                    <div class="card-header">
                        <h3>Korisnici</h3>
                        <a href="{{ route('register') }}" class="btn-add">
                            <i class="fas fa-add"></i> Dodaj korisnika
                        </a>
                    </div>
                    <div class="table-container">
                        <table>
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Ime</th>
                                    <th>Prezime</th>
                                    <th>Email</th>
                                    <th>Telefon</th>
                                    <th>Uloga</th>
                                    <th>Akcije</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        <td>{{ $user->id }}</td>
                                        <td>{{ $user->first_name }}</td>
                                        <td>{{ $user->last_name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->phone_number }}</td>
                                        <td>{{ $user->role->name }}</td>
                                        <td class="actions">
                                            <form action="{{ route('delete_user', $user->id) }}" method="POST"
                                                id="delete-form-{{ $user->id }}"
                                                class="delete-property-tag-form">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn-delete">
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
                <div x-show="currentTab === 'properties'" x-cloak class="card">
                    <div class="card-header">
                        <h3>Nekretnine</h3>
                    </div>
                    <div class="table-container">
                        <table>
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Naslov</th>
                                    <th>Adresa</th>
                                    <th>Cena</th>
                                    <th>Vlasnik</th>
                                    <th>m²</th>
                                    <th>Tip</th>
                                    <th>Vrsta</th>
                                    <th>Grejanje</th>
                                    <th>Status</th>
                                    <th>Akcije</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($properties as $property)
                                    <tr>
                                        <td>{{ $property->id }}</td>
                                        <td>{{ $property->title }}</td>
                                        <td>
                                            @php
                                                $addressArray = explode(',', $property->address);
                                            @endphp
                                            {{ $addressArray[0] ?? '' }}, {{ $addressArray[1] ?? '' }}
                                        </td>
                                        <td>{{ $property->rent_price }}</td>
                                        <td>{{ $property->owner->first_name }} {{ $property->owner->last_name }}</td>
                                        <td>{{ $property->area }}</td>
                                        <td>{{ $property->type }}</td>
                                        <td>{{ $property->property_type }}</td>
                                        <td>{{ $property->heating }}</td>
                                        <td>
                                            <span
                                                class="status-badge {{ $property->status === 'active' ? 'status-active' : 'status-inactive' }}">
                                                {{ $property->status }}
                                            </span>
                                        </td>
                                        <td class="actions">
                                            <form action="{{ route('property_delete', $property->id) }}"
                                                id="delete-form-{{ $property->id }}" method="POST"
                                                class="delete-property-tag-form">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn-delete">
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
                <div x-show="currentTab === 'propertyTags'" x-cloak class="card">
                    <div class="card-header">
                        <h3>Tagovi nekretnina</h3>
                        <a href="{{ route('property_tags_create') }}" class="btn-add">
                            <i class="fas fa-plus"></i> Dodaj tag
                        </a>
                    </div>
                    <div class="table-container">
                        <table>
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Tag</th>
                                    <th>Akcije</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($propertyTags as $propertyTag)
                                    <tr>
                                        <td>{{ $propertyTag->id }}</td>
                                        <td>{{ $propertyTag->tag }}</td>
                                        <td class="actions">
                                            <a href="{{ route('property_tag_edit', $propertyTag->id) }}"
                                                class="btn-edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('property_tag_delete', $propertyTag->id) }}"
                                                id="delete-form-{{ $propertyTag->id }}" method="POST"
                                                class="delete-property-tag-form">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn-delete">
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
                <div x-show="currentTab === 'reviews'" x-cloak class="card">
                    <div class="card-header">
                        <h3>Recenzije</h3>
                    </div>
                    <div class="table-container">
                        <table>
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Id nekretnine</th>
                                    <th>Kreator</th>
                                    <th>Sadržaj</th>
                                    <th>Akcije</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($reviews as $review)
                                    <tr>
                                        <td>{{ $review->id }}</td>
                                        <td>{{ $review->property_id }}</td>
                                        <td>{{ $review->user->first_name }} {{ $review->user->last_name }}</td>
                                        <td>{{ $review->comment }}</td>
                                        <td class="actions">
                                            <form action="{{ route('review_delete', $review->id) }}" method="POST"
                                                id="delete-form-{{ $review->id }}"
                                                class="delete-property-tag-form">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn-delete">
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
