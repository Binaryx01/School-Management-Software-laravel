🎓 School Management System (Beta)

This is a comprehensive Full-Stack School Management System that includes both:

    A frontend website for public users and visitors

    A robust backend/admin panel for managing core school operations

<img width="1270" height="873" alt="image" src="https://github.com/user-attachments/assets/51790477-f61a-4b61-aec7-9ea69c9e5a9c" />

<img width="1286" height="876" alt="image" src="https://github.com/user-attachments/assets/c5f57ea9-359f-4953-a6f4-7030e7ff5c79" />

⚠️ Beta Notice

    Note: This project is currently in the beta phase. While many core features are operational, active development is still in progress. You may encounter bugs or incomplete modules. Feedback and contributions are highly appreciated to help improve and stabilize the system.

📋 Requirements

    PHP 8.1 or higher

    Composer

    Node.js & npm

    MySQL or other supported database

    Laravel 12 (Check official Laravel requirements)

🛠️ Installation Instructions

Follow the steps below to set up the project locally:

    Create a new database in your local server (e.g., MySQL).

    Clone the repository and open the project folder in your IDE.

    Copy .env.example and rename the copied file to .env.

    Update the .env file with your database credentials (DB name, user, password).

    Ensure Composer and Node.js are installed on your system.

    Run the following commands in your terminal:

composer install
php artisan key:generate
php artisan migrate --seed
npm install && npm run dev
php artisan serve

    Access the application at:
    http://localhost:8000 or your configured domain.

🔐 Default Login Credentials

Use the following credentials to access the admin dashboard (if seeders are enabled):

Email: admin@gmail.com
Password:admin

✅ Features (So Far)

    Session Management

    Student Enrollment

    Teachers & Staff Management

    Class & Section Management

    Exams & Results

    Dashboard & Reports

📄 License

This project is open-source and licensed under the MIT License.
