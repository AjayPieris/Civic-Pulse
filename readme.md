# 📢 CivicPulse — Community Issue Tracker

<p align="center">
  <img src="screenshots/dashboard.png" alt="CivicPulse Dashboard" width="85%" />
</p>

<p align="center">
  <a href="#-features">Features</a> •
  <a href="#-tech-stack">Tech Stack</a> •
  <a href="#-used-languages--icons">Used Languages & Icons</a> •
  <a href="#-screenshots">Screenshots</a> •
  <a href="#-installation-guide">Installation</a> •
  <a href="#-admin-setup">Admin Setup</a> •
  <a href="#-roadmap">Roadmap</a> •
  <a href="#-contributing">Contributing</a> •
  <a href="#-license">License</a>
</p>

---

## ✨ Highlights

- Modern dark UI with glassmorphism and motion‑safe animations
- Clear separation of Citizen vs Admin capabilities
- Secure authentication, CSRF protection, and route model binding
- Image uploads with storage symlink support
- Accessible forms with validation messaging

---

## 🚀 Features

### 👤 Citizen
- Authentication: Secure login and registration
- Create Reports: Title, description, and image upload
- Dashboard: Responsive grid of community issues
- Ownership: Edit/Delete only your own reports
- Feedback: Animated success toasts and validation errors

### 🛡️ Admin
- Status Management: Update issue status (`Pending` → `In Progress` → `Resolved`)
- Admin‑only Controls: Visible only to authorized users
- Dashboard Overview: View all issues; filters (planned)

---

## 🛠️ Tech Stack

- Framework: Laravel (PHP 8.2+)
- Frontend: Blade, Tailwind CSS (CDN), Alpine.js
- Database: MySQL
- Architecture: MVC
- Security: CSRF, Policies/Gates, Route Model Binding

---

## 🔤 Used Languages & Icons

<p align="left">
  <!-- Shields (quick badges) -->
  <img alt="Laravel" src="https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white">
  <img alt="Blade" src="https://img.shields.io/badge/Blade-2C2C2C?style=for-the-badge&logo=laravel&logoColor=white">
  <img alt="MySQL" src="https://img.shields.io/badge/MySQL-4479A1?style=for-the-badge&logo=mysql&logoColor=white">
  <img alt="Tailwind CSS" src="https://img.shields.io/badge/Tailwind-38B2AC?style=for-the-badge&logo=tailwindcss&logoColor=white">
  <img alt="Alpine.js" src="https://img.shields.io/badge/Alpine.js-8BC0D0?style=for-the-badge&logo=alpinedotjs&logoColor=1F2937">
  <img alt="PHP" src="https://img.shields.io/badge/PHP-777BB3?style=for-the-badge&logo=php&logoColor=white">
</p>

<p align="left">
  <!-- Devicon (vector icons) -->
  <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/laravel/laravel-plain.svg" alt="Laravel" width="40" height="40"/>
  <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/php/php-original.svg" alt="PHP" width="40" height="40"/>
  <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/mysql/mysql-original.svg" alt="MySQL" width="40" height="40"/>
  <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/tailwindcss/tailwindcss-original.svg" alt="Tailwind CSS" width="40" height="40"/>
</p>

> Notes:
> - Blade is the templating engine within Laravel (badge included for clarity).
> - Icons sourced from Shields.io and Devicon (CDN). You can reorder or resize as needed.

---

## 📸 Screenshots

| Dashboard (Grid) | Issue Details (Admin) |
| :---: | :---: |
| ![Dashboard](screenshots/dashboard.png) | ![Details](screenshots/admin_view.png) |

| Create Report | Mobile Responsive |
| :---: | :---: |
| ![Create](screenshots/create_issue.png) | ![Mobile](screenshots/mobile.png) |

---

## ⚙️ Installation Guide

### 1) Clone the Repository
```bash
git clone https://github.com/yourusername/civic-pulse.git
cd civic-pulse
```

### 2) Install Dependencies
```bash
composer install
```

### 3) Environment Setup
```bash
cp .env.example .env
php artisan key:generate
```

Update `.env` with your database credentials:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=civic_pulse
DB_USERNAME=root
DB_PASSWORD=
```

### 4) Create Database
Create a database named `civic_pulse` (phpMyAdmin/MySQL Workbench/etc.)

### 5) Run Migrations
```bash
php artisan migrate
```

### 6) Link Storage (for images)
```bash
php artisan storage:link
```

### 7) Run the Application
```bash
php artisan serve
```
Visit http://127.0.0.1:8000

---

## 🔑 Admin Setup

Promote a user to Admin:
```bash
php artisan tinker
```
```php
$user = App\Models\User::where('email', 'admin@example.com')->first();
$user->is_admin = true;
$user->save();
exit
```

---

## 📦 Key Views

- `resources/views/layouts/app.blade.php` — Base layout and theming
- `resources/views/issues/index.blade.php` — Issues listing
- `resources/views/issues/show.blade.php` — Issue details + admin actions
- `resources/views/issues/create.blade.php` — Create form
- `resources/views/issues/edit.blade.php` — Edit form
- `resources/views/auth/login.blade.php` — Login
- `resources/views/auth/register.blade.php` — Register

---

## 🗺️ Roadmap

- Filters/search on dashboard
- Role management UI
- Comments on issues
- Email notifications for status changes
- Analytics for authorities

---

## 🤝 Contributing

1. Fork the repo
2. Create a feature branch
3. Commit with clear messages
4. Open a pull request (include screenshots/GIFs for UI changes)

---

## 📄 License

MIT License. See `LICENSE` for details.

---

## ✅ Job‑Ready Checklist

```bash
git init
echo "/public/storage" >> .gitignore
git remote add origin https://github.com/yourusername/civic-pulse.git
git add .
git commit -m "Initial commit: CivicPulse"
git push -u origin main
```

CivicPulse makes community reporting simple and effective. 🚀