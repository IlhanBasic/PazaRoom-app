# PazaRoom 🏠

PazaRoom is a Laravel-based platform designed to help students find and rent accommodation efficiently. It connects property owners with students, providing a secure and feature-rich environment for managing student housing.

## Features 🌟

### For Students
- Browse available accommodations with advanced filtering options
- Search properties by location, price, tags, and more
- View detailed property information, including photos and reviews
- Submit reviews for properties you've stayed at
- Manage and update your personal profile
- Easily contact property owners

### For Property Owners
- List properties with detailed descriptions and pricing
- Manage property listings, including editing and deleting
- Upload photos and manage property galleries
- Update property availability and offer booking options

### For Administrators
- Approve and manage new property listings
- Administer user accounts and roles (students and property owners)
- Manage property tags, categories, and site-wide settings

### User Roles
There are three main roles in the platform:
1. **Administrator** - Responsible for platform management and oversight
2. **Property Owner** - Can list, manage, and update properties
3. **Student** - Can browse, search, and book properties

## Technical Features 🔧

### Search & Filter System
- Advanced search with multiple filter combinations (location, price, tags, etc.)
- Real-time updating of search results
- Location-based property search using GPS and map data

### User Management
- Secure authentication using Laravel's built-in authentication system
- Role-based access control using Laravel's policies and gates
- User profile management, including registration, login, and password recovery
- Account verification via email to ensure genuine users

### Property Management
- Ability to create, edit, and delete property listings
- Upload and manage property photos using Laravel file storage
- Integration of availability calendars to manage booking dates
- Simple and intuitive booking management for property owners

## Security 🔒

- Secure user authentication via Laravel's built-in JWT or session-based login system
- Data encryption for sensitive information (using Laravel's encryption features)
- Role-based access control for feature restrictions (using Laravel's policies and gates)
- Regular security audits and updates
- GDPR compliance for data protection and privacy
- Protected user data through secure protocols and best practices

## Getting Started 🚀

### Prerequisites
Ensure you have the following installed:
- PHP >= 7.4
- Composer (for PHP dependencies)
- Laravel >= 8.x
- MySQL or another database of your choice

### Installation

1. Clone the repository:
```bash
git clone https://github.com/IlhanBasic/PazaRoom-app.git
```

2. Navigate to the project directory:
```bash
cd PazaRoom-app
```

3. Install PHP dependencies using Composer:
```bash
composer install
```

4. Set up your .env file:
```bash
cp .env.example .env
```
Then, edit the .env file to set up your database connection.

5. Generate the application key:
```bash
php artisan key:generate
```

6. Run database migrations:
```bash
php artisan migrate
```

7. Start the Laravel development server:
```bash
php artisan serve
```

Once the server is running, you can access the application in your browser at http://localhost:8000.

## Contributing 🤝

1. Fork the Project
2. Create your Feature Branch (`git checkout -b feature/AmazingFeature`)
3. Commit your Changes (`git commit -m 'Add some AmazingFeature'`)
4. Push to the Branch (`git push origin feature/AmazingFeature`)
5. Open a Pull Request

Made with ❤️ for students seeking their perfect home
