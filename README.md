# Bayan Demo

A Laravel application with roles & permissions, posts, and a bilingual (Arabic/English) interface.

## Requirements

- PHP 8.2+
- Composer
- Node.js & npm
- [Laravel Herd](https://herd.laravel.com/) (or any local web server like Valet, Sail, etc.)
- SQLite (default) or MySQL

## Setup Instructions

### 1. Clone & Install Dependencies

```bash
git clone <repository-url> bayan_demo
cd bayan_demo
composer install
npm install
```

### 2. Configure Environment

Copy the example environment file and generate an application key:

```bash
cp .env.example .env
php artisan key:generate
```

In `.env`, verify the database settings. SQLite is the default:

```
DB_CONNECTION=sqlite
```

### 3. Create the SQLite Database

Create the SQLite database file (skip if using MySQL):

```bash
php -r "touch database/database.sqlite"
```

### 4. Run Migrations & Seed the Database

```bash
php artisan migrate:fresh --seed
```

This creates the tables and seeds default users, roles, and sample posts.

### 5. Build Frontend Assets

```bash
npm run build
```

For development with hot-reloading, run:

```bash
npm run dev
```

### 6. Start the Server (Herd)

Open the project in [Laravel Herd](https://herd.laravel.com/) or run:

```bash
php artisan serve
```

Visit `http://app.test` (Herd) or `http://127.0.0.1:8000` (artisan serve) in your browser. The root URL redirects to the login page.

## Default Seeded Users

| Role   | Email                | Password |
|--------|----------------------|----------|
| Admin  | admin@example.com    | password |
| Editor | editor@example.com   | password |
| User   | user@example.com     | password |

## Language Toggle

The app supports both Arabic and English. Use the **EN / عربي** toggle in the top-right corner of any page to switch languages. The interface will switch to right-to-left (RTL) layout when Arabic is selected.

## Features

- **Authentication** - Login, registration, password reset, email verification
- **Roles & Permissions** - Admin, Editor, and User roles (via Spatie Permission)
- **Posts** - Create, edit, delete, and view posts
- **User Management** (Admin) - Browse, edit roles, and delete users
- **Profile** - Name, email, and password updates, account deletion
- **Preferences** - Persistent locale and theme preferences
- **Bilingual** - Full Arabic and English translation support

## Project Structure

- `app/Models` - Eloquent models (User, Post)
- `app/Http/Controllers` - Application controllers
- `app/Http/Controllers/Auth` - Authentication controllers
- `app/Http/Controllers/Admin` - Admin management
- `resources/views` - Blade templates
- `lang/` - Translation files (ar & en)
- `database/migrations` - Database schema
- `database/seeders` - Seed data

## Useful Commands

```bash
php artisan migrate:fresh --seed   # Reset and re-seed the database
npm run build                      # Build production assets
npm run dev                        # Dev server with hot reload
php artisan config:clear           # Clear config cache
```