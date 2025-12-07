📢 CivicPulse - Community Issue Tracker

A full-stack web application designed to bridge the gap between citizens and local authorities. Citizens can report infrastructure issues (like potholes, broken lights), and administrators can track, update, and resolve them.

![Project Banner](screenshots/dashboard.png)
*(Place your main screenshot here)*

## 🚀 Features

### 👤 User (Citizen)
- **Authentication:** Secure Login and Registration system.
- **Create Reports:** Submit issues with a Title, Description, and **Image Upload**.
- **Dashboard:** View all community issues in a modern, responsive grid layout.
- **Ownership:** Users can only Edit or Delete their *own* reports.
- **Real-time Feedback:** Animated success messages and form validation errors.

### 🛡️ Admin (Authority)
- **Status Management:** Exclusive ability to change issue status (`Pending` → `In Progress` → `Resolved`).
- **Visual Distinction:** Admins see special controls that regular users do not.
- **Dashboard Overview:** View all issues and filter by status (future feature).

---

## 🛠️ Tech Stack

- **Framework:** Laravel (PHP 8.2+)
- **Frontend:** Laravel Blade, Tailwind CSS (via CDN), Alpine.js (Animations)
- **Database:** MySQL
- **Architecture:** MVC (Model-View-Controller)
- **Security:** CSRF Protection, Route Model Binding, Policies/Gates

---

## 📸 Screenshots

| Dashboard (Grid View) | Issue Details (Admin View) |
| :---: | :---: |
| ![Dashboard](screenshots/dashboard.png) | ![Details](screenshots/admin_view.png) |

| Create Report Form | Mobile Responsive |
| :---: | :---: |
| ![Create Form](screenshots/create_issue.png) | *(Add mobile screenshot here)* |

---

## ⚙️ Installation Guide

Follow these steps to run the project locally:

### 1. Clone the Repository
```bash
git clone [https://github.com/yourusername/civic-pulse.git](https://github.com/yourusername/civic-pulse.git)
cd civic-pulse
2. Install Dependencies
Bash

composer install
3. Environment Setup
Rename the example environment file and generate the app key:

Bash

cp .env.example .env
php artisan key:generate
4. Database Setup
Open your database tool (phpMyAdmin or Workbench).

Create a new database named civic_pulse.

Configure your .env file:

Code snippet

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=civic_pulse
DB_USERNAME=root
DB_PASSWORD=
5. Run Migrations
Create the database tables:

Bash

php artisan migrate
6. Link Storage (Crucial for Images)
This command exposes the storage folder so images are visible:

Bash

php artisan storage:link
7. Run the Application
Bash

php artisan serve
Visit http://127.0.0.1:8000 in your browser.

🔑 Creating an Admin User
By default, all new registrations are Citizens. To create an Admin:

Register a new user on the website (e.g., admin@example.com).

Open your terminal and run:

Bash

php artisan tinker
Run these commands:

PHP

$user = App\Models\User::where('email', 'admin@example.com')->first();
$user->is_admin = true;
$user->save();
exit
Log out and log back in. You will now see Admin controls.

🤝 Contributing
Contributions are welcome! Please fork the repository and submit a pull request.

📄 License
This project is open-source and available under the MIT License.


### **Next Steps to "Job Ready"**

1.  **Git Init:** Run `git init` in your project folder.
2.  **Ignore Photos:** Make sure your `.gitignore` file includes `/public/storage`. You don't want to upload your test photos to GitHub.
3.  **Push:** Create a repository on GitHub and push your code.

You have built something impressive. Good luck with the job hunt! 🚀