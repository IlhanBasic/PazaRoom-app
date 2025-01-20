@section('title', 'PazaRoom - About')
<x-layout>
    <link rel="stylesheet" href="{{ asset('css/about.css') }}">
    <!-- Hero Section -->
    <section class="hero-section">
        <div class="hero-content">
            <h1>O PazaRoom-u</h1>
            <div class="hero-text">
                <p>PazaRoom je premium platforma za iznajmljivanje smeštaja koja povezuje studente i vlasnike smeštaja u potrazi za sigurnim i udobnim prostorima.</p>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section class="about-section">
        <div class="container">
            <div class="about-grid">
                <div class="about-image">
                    <img src="{{ asset('images/logo.png') }}" alt="PazaRoom About Us" class="main-image">
                    <div class="image-accent"></div>
                </div>
                <div class="about-content">
                    <h2>Naša Misija</h2>
                    <p class="mission-text">PazaRoom je stvoren da revolucionarizuje način na koji studenti pronalaze svoj idealni smeštaj na teritoriji grada Novog Pazara. Kroz inovativnu tehnologiju i posvećenost kvalitetu, stvaramo mostove između studenata i proverenih stanodavaca.</p>
                    
                    <div class="features">
                        <div class="feature-item">
                            <div class="feature-icon">🔍</div>
                            <h3>Pametna Pretraga</h3>
                            <p>Napredni filtri koji vode do savršenog smeštaja u nekoliko klikova</p>
                        </div>
                        <div class="feature-item">
                            <div class="feature-icon">🛡️</div>
                            <h3>Sigurnost</h3>
                            <p>100% provereni oglasi i stanodavci</p>
                        </div>
                        <div class="feature-item">
                            <div class="feature-icon">📍</div>
                            <h3>Lokacija</h3>
                            <p>Detaljne informacije o lokaciji smeštaja u Novom Pazaru</p>
                        </div>
                        
                        <div class="feature-item">
                            <div class="feature-icon">💬</div>
                            <h3>Brza Komunikacija</h3>
                            <p>Kontakt informacije stanodavaca</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Team Section -->
    <section class="team-section">
        <div class="container">
            <h2>Upoznajte Naš Tim</h2>
            <p class="team-intro">Iza PazaRoom-a stoji tim stručnjaka posvećenih stvaranju najbolje platforme za studentski smeštaj.</p>
            
            <div class="team-grid">
                <div class="team-member">
                    <div class="member-image">
                        <img src="../images/man2.jpg" alt="Jovan Jovanović">
                    </div>
                    <div class="member-info">
                        <h3>Haris Bešić</h3>
                        <span class="position">Osnivač i CEO</span>
                        <p>Vizionar sa 10+ godina iskustva u tech industriji</p>
                    </div>
                </div>

                <div class="team-member">
                    <div class="member-image">
                        <img src="../images/woman1.jpg" alt="Marija Marković">
                    </div>
                    <div class="member-info">
                        <h3>Alida Suljević</h3>
                        <span class="position">Tehnička Direktorka</span>
                        <p>Stručnjak za razvoj i implementaciju inovativnih rešenja</p>
                    </div>
                </div>

                <div class="team-member">
                    <div class="member-image">
                        <img src="../images/man1.jpg" alt="Nikola Nikolić">
                    </div>
                    <div class="member-info">
                        <h3>Nikola Nikolić</h3>
                        <span class="position">Menadžer za korisničku podršku</span>
                        <p>Posvećen pružanju izvanrednog korisničkog iskustva</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="stats-section">
        <div class="container">
            <div class="stats-grid">
                <div class="stat-item">
                    <span class="stat-number">40+</span>
                    <span class="stat-label">Aktivnih Oglasa</span>
                </div>
                <div class="stat-item">
                    <span class="stat-number">200+</span>
                    <span class="stat-label">Zadovoljnih Studenata</span>
                </div>
                <div class="stat-item">
                    <span class="stat-number">98%</span>
                    <span class="stat-label">Pozitivnih Ocena</span>
                </div>
            </div>
        </div>
    </section>
</x-layout>