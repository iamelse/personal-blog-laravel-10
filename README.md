# Portfolio and Blog App

This project is a personal **Portfolio and Blog** application built using the **Laravel 10** framework. It serves as both a blog platform and a portfolio to showcase personal projects, experiences, and skills. It also features a CMS for content management and a dashboard with detailed post statistics and developer tools.

## Features

### User Features:
- **Login and Authentication**: Secure user login and registration.
- **Portfolio Showcase**: Display your projects, experience, education, and skills.
- **Blog**: Publish, edit, and manage blog posts.

### Admin Features:
- **Dashboard with Filters**:
  - View post statistics such as:
    - Post views
    - User devices
    - Operating Systems (OS)
    - Browsers
    - Countries
- **CMS**:
  - Manage Posts (create, edit, delete)
  - Manage Post Categories
  - Manage Portfolio sections (About, Projects, Experience, Education, Skills)
  - Manage Users
- **Developer Menu**:
  - Run Artisan commands from the dashboard.
  - View application logs directly from the admin panel.
- **Laravel File Manager**: Manage media files through an integrated file manager.

## Tech Stack

- **Backend:** Laravel 10 (PHP 8.2)
- **Frontend:** Blade, Bootstrap
- **Database:** MySQL
- **Other**:
  - Spatie Laravel Permissions (for user roles and permissions)
  - Laravel Task Scheduling (for post scheduling, if implemented)
  - **Laravel File Manager** for managing uploaded files.

## Installation

1. Clone the repository:
   ```bash
   git clone https://github.com/your-username/portfolio-blog-app.git

2. Navigate to the project directory:
   ```bash
   cd portfolio-blog-app

3. Install dependencies
   ```bash
   composer install
   npm install

4. Copy the .env file and set up your environment variables:
   ```bash
   cp .env.example .env

5. Generate the application key:
   ```bash
   php artisan key:generate

6. Set up the database in the .env file and run migrations:
   ```bash
   php artisan migrate

7. Seed the database (optional):
   ```bash
   php artisan db:seed

8. Build the assets:
   ```bash
   npm run build

9. Serve the application:
   ```bash
   php artisan serve

10. Open your browser and navigate to http://127.0.0.1:8000.

## Contribution

Feel free to fork this repository and make contributions. Pull requests are welcome!

## Screenshots

![Home](screenshots/home.jpg)
![About](screenshots/about.png)
![Projects](screenshots/projects.png)
![Resume](screenshots/resume.png)
![Article](screenshots/article.png)

## License

This project is open-sourced software licensed under the MIT license.

Built with ❤️ using Laravel 10
