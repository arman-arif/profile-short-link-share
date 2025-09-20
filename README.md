# Laravel Dual Authentication System

A Laravel 12.x application with dual authentication system for Users and Admins, featuring Bootstrap frontend, Google reCAPTCHA protection, user referral system with social media integration.

Live Preview: [http://profile-card.aarif.co](http://profile-card.aarif.co/)

## Features

- **Dual Authentication System**
  - Separate authentication for Users and Admins
  - Single unified login page with automatic user type detection
  - Google reCAPTCHA v2 protection on login and registration
  - Progressive login attempt blocking (3 attempts = 15 min block, 6 attempts = 45 min block)

- **User Management**
  - User self-registration with email verification
  - Admin-generated accounts via seeder
  - Admin dashboard with user list, pagination, and management controls
  - User profile with personal information and avatar

- **Referral System**
  - Unique short links for each user
  - Social media integration with dynamic Open Graph meta tags
  - Public user profile pages accessible via short links

- **Frontend**
  - Bootstrap 5.x for responsive UI
  - Clean, modern interface
  - Mobile-friendly design

## System Requirements

- PHP >= 8.2
- Composer
- Node.js >= 22.x
- MySQL/SQLite
- Google reCAPTCHA v2 keys

## Installation

### 1. Clone and Setup

```bash
git clone <repository-url>
cd <project-folder>
composer install
pnpm install / npm install
```

### 2. Environment Configuration

```bash
cp .env.example .env
php artisan key:generate
```

### 3. Database Configuration

Edit `.env` file with your database credentials:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

### 4. Google reCAPTCHA Setup

1. Visit [Google reCAPTCHA](https://www.google.com/recaptcha/)
2. Register your domain and get Site Key & Secret Key
3. Add to `.env`:

```env
CAPTCHA_SITEKEY=your_site_key_here
CAPTCHA_SECRET=your_secret_key_here
```

### 5. Database Migration and Seeding

```bash
php artisan migrate
php artisan db:seed
```

This will create:
- Users table for customer registration
- Admins table for admin accounts
- Default admin account (see seeder for credentials)

### 6. Storage Setup

```bash
php artisan storage:link
```

### 7. Build Frontend Assets

```bash
pnpm build / npm run build
# or for development
pnpm dev / npm run dev
```

### 8. Start Development Server

```bash
php artisan serve
```

Visit `http://localhost:8000` to access the application.

## Default Admin Credentials

After running the seeder, use these credentials to access admin panel:

- **Email**: admin@example.com
- **Password**: password

*Note: Change these credentials immediately after first login*

## Authentication Flow

### User Registration
1. User visits registration page
2. Fills form with: name, email, password, about, avatar
3. Completes Google reCAPTCHA
4. Account created instantly (no email verification required)
5. Unique short link generated for social sharing

### Login Process
1. Single login page for both users and admins
2. Google reCAPTCHA verification required
3. System automatically detects user type (user vs admin)
4. Failed login attempt tracking:
   - 3 failed attempts = 15 minute block
   - 6 failed attempts = 45 minute block
5. Redirect to appropriate dashboard

## Admin Features

### User Management Dashboard
- Paginated list of all registered users
- Search and filter capabilities
- User actions:
  - View user details
  - Diable/Enable users
  - Delete user accounts


## Social Media Sharing

### Short Link Generation
Each user gets a unique short link format:
```
https://yourdomain.com/u/{unique_code}
```

### Social Media Integration
When shared on social platforms, the link displays:
- User's name
- Email
- About description
- Avatar image

### Usage
1. User copies their unique link from dashboard
2. Shares on social media platforms
3. Visitors click link and see user's profile
4. Call-to-action button leads to registration form
