<x-layout>
    <link rel="stylesheet" href="{{ asset('css/contact.css') }}">
    <!-- Hero Section -->
    <section class="contact-hero">
        <div class="contact-hero-overlay"></div>
        <div class="container">
            <div class="contact-hero-content">
                <span class="contact-tag">Kontaktirajte Nas</span>
                <h1>Kako Vam Možemo Pomoći?</h1>
                <p>Tu smo da odgovorimo na sva vaša pitanja i pomognemo vam da pronađete savršen smeštaj</p>
            </div>
        </div>
    </section>

    <!-- Contact Form Section -->
    <section class="contact-section">
        <div class="container">
            <div class="contact-wrapper">
                <div class="contact-info">
                    <div class="info-header">
                        <h2>Ostanimo u Kontaktu</h2>
                        <p>Izaberite način koji vam najviše odgovara</p>
                    </div>
                    
                    <div class="contact-methods">
                        <div class="contact-method">
                            <div class="method-icon">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/>
                                </svg>
                            </div>
                            <div class="method-content">
                                <h3>Telefon</h3>
                                <p>+381 60 1234 567</p>
                            </div>
                        </div>

                        <div class="contact-method">
                            <div class="method-icon">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/>
                                    <path d="M22 6l-10 7L2 6"/>
                                </svg>
                            </div>
                            <div class="method-content">
                                <h3>Email</h3>
                                <p>info@pazaroom.com</p>
                            </div>
                        </div>

                        <div class="contact-method">
                            <div class="method-icon">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/>
                                    <circle cx="12" cy="10" r="3"/>
                                </svg>
                            </div>
                            <div class="method-content">
                                <h3>Adresa</h3>
                                <p>8 mart 97, Novi Pazar</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="contact-form-container">
                    <form class="contact-form" action="{{route('contact_create')}}" method="POST">
                        @csrf
                        
                        @guest
                            <div class="form-group">
                                <label for="name">Ime i Prezime</label>
                                <input type="text" id="name" name="name" required placeholder="Vaše ime i prezime">
                            </div>

                            <div class="form-group">
                                <label for="email">Email Adresa</label>
                                <input type="email" id="email" name="email" required placeholder="vasa@email.com">
                            </div>
                        @endguest
                        @auth
                            <input type="hidden" name="name" value="{{ auth()->user()->first_name }} {{ auth()->user()->last_name }}">
                            <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                            <input type="hidden" name="email" value="{{ auth()->user()->email }}">
                        @endauth
                        <div class="form-group">
                            <label for="subject">Naslov</label>
                            <input type="text" id="subject" name="subject" required placeholder="Tema vaše poruke">
                        </div>

                        <div class="form-group">
                            <label for="message">Poruka</label>
                            <textarea id="message" name="message" required placeholder="Unesite vašu poruku ovde..." rows="5"></textarea>
                        </div>

                        <button type="submit" class="submit-button">
                            <span>Pošalji Poruku</span>
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M22 2L11 13M22 2l-7 20-4-9-9-4 20-7z"/>
                            </svg>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>
</x-layout>