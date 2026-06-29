# BHW Web

Barangay Health Worker (BHW) web application built with Laravel. This system supports health record management, schedule coordination, announcements, and reporting workflows for BHW users and administrative roles.

## Overview

The project is designed around the day-to-day work of barangay health staff in the Philippines. It provides a central web portal for:

- registering and managing BHW accounts
- logging in and resetting passwords
- managing health service records
- tracking household, child, maternal, and reproductive health data
- organizing schedules and duty assignments
- publishing announcements and notices
- viewing summary lists and analytics for program reporting
- displaying map-based location data

The landing page presents the Department of Health and Barangay Health Workers branding, with separate sign-up and login entry points.

## Main User Roles

The application routes indicate three main access levels:

- `Super Admin / President` - highest-level administrative access for dashboard, registration, announcements, and summary views
- `Admin Midwife` - operational access for schedules, duty monitoring, user activity, and service management
- `BHW` - field-level access for records, forms, schedules, monthly reports, and profile settings

## Core Modules

From the routes and views in this project, the main modules include:

- Dashboard and location map
- Announcements
- BHW registration management
- Schedule management
- Duty schedule tracking
- User activity logs
- Services catalog
- Child census
- Maternal care records
- Family planning records
- Women reproductive age records
- Deworming records
- Census forms and data lists
- Monthly report printing
- Summary lists and analytics for program data
- Profile and account settings

## Technology Stack

- Laravel 10
- PHP 8.1+
- Vite for frontend asset building
- Bootstrap-based UI assets
- MySQL or another Laravel-supported database
- Laravel Sanctum
- Pusher support for real-time features
- QR code generation via `simplesoftwareio/simple-qrcode`

## Project Structure

Some of the important folders in this repository are:

- `app/Http/Controllers` - request handling and feature logic
- `app/Models` - Eloquent models for the system data
- `database/migrations` - database schema definitions
- `database/seeders` - initial data seeders
- `resources/views` - Blade templates for public, admin, and BHW pages
- `public/js` and `resources/js` - frontend scripts
- `public/css` - compiled and static styles
- `routes/web.php` - main web routes and role-based access rules

## Requirements

- PHP 8.1 or newer
- Composer
- Node.js and npm
- Database server such as MySQL or MariaDB

## Installation

1. Clone the repository.
2. Install PHP dependencies:

   ```bash
   composer install
   ```

3. Install frontend dependencies:

   ```bash
   npm install
   ```

4. Create your environment file:

   ```bash
   copy .env.example .env
   ```

5. Generate the application key:

   ```bash
   php artisan key:generate
   ```

6. Configure your database and other environment values in `.env`.
7. Run migrations and seeders if needed:

   ```bash
   php artisan migrate --seed
   ```

## Running the Application

Start the Laravel backend:

```bash
php artisan serve
```

In a second terminal, start the Vite development server:

```bash
npm run dev
```

Then open the local app URL shown by Laravel, usually:

```bash
http://127.0.0.1:8000
```

## Common Artisan Commands

- `php artisan migrate` - run database migrations
- `php artisan db:seed` - seed the database
- `php artisan test` - run automated tests
- `php artisan route:list` - inspect available routes

## Testing

This repository includes PHPUnit and Laravel Dusk test scaffolding. You can run the available test suite with:

```bash
php artisan test
```

## Notes

- The repository includes several prebuilt UI asset folders under `public/`, including `Vesperr` and `theme`.
- The current README is tailored to the BHW portal rather than the default Laravel starter content.
- If you plan to deploy this system, make sure to review environment values, database credentials, queue settings, mail settings, and any broadcast configuration.

## License

This project inherits the license of the repository and its dependencies. If you want, add a dedicated license section here for your deployment or organization policy.
