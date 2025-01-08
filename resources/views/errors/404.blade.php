<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>404 - Stranica nije pronađena</title>
    <link rel="stylesheet" href="{{ asset('css/error-page.css') }}">
</head>
<body class="error-404-page antialiased">
    <div class="error-404-container">
        <div class="error-404-content">
            <div class="error-404-icon-container">
                <svg class="error-404-error-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                </svg>
            </div>
            
            <h1 class="error-404-title">404</h1>
            <h2 class="error-404-subtitle">Stranica nije pronađena</h2>
            
            <p class="error-404-description">
                Ups! Stranica koju tražite je nestala u digitalnom svemiru.
            </p>
            
            <div class="error-404-button-container">
                <a href="{{ url('/') }}" class="error-404-back-button">
                    <svg xmlns="http://www.w3.org/2000/svg" class="error-404-back-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                    </svg>
                    Povratak na početnu
                </a>
            </div>
        </div>
    </div>
</body>
</html>