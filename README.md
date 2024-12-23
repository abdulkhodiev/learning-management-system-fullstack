# LMS Admin Panel

## Installation Guide

This is the admin panel for the LMS (Learning Management System) built with Laravel, Inertia.js, Vue 3, and Sail. Follow the steps below to set up the project on your local environment.

### Prerequisites

Before starting the installation, ensure that the following dependencies are installed:

- [Docker](https://www.docker.com/products/docker-desktop) (for running the application in containers via Sail)
- [PHP](https://www.php.net/downloads.php) (PHP 8.3 or higher)
- [Composer](https://getcomposer.org/download/) (for managing PHP dependencies)
- [Node.js](https://nodejs.org/en/download/) (for building and running JavaScript assets)
- [npm](https://docs.npmjs.com/downloading-and-installing-node-js-and-npm) or [yarn](https://classic.yarnpkg.com/en/docs/install/) (for managing JavaScript packages)

### Step 1: Clone the Repository

Clone the repository to your local machine using Git:

```bash
git clone https://github.com/abdulkhodiev/learning-management-system-fullstack.git
cd learning-management-system-fullstack
```

### Step 2: Install PHP and JavaScript Dependencies

Install PHP dependencies using Composer:

First, ensure Composer is installed. If not, download and install it from here.

Run the following command to install PHP dependencies:

```bash
./vendor/bin/sail composer install
```

Install JavaScript dependencies using npm (or yarn):

You can use either npm or yarn. To install using npm, run:

```bash
./vendor/bin/sail npm install
```

Or, if you're using Yarn:

```
bash
./vendor/bin/sail yarn install
```

### Step 3: Set Up the Environment File

Copy the .env.example to .env:

Laravel uses the .env file to manage environment variables. Copy the example environment file to create your .env file:

```bash
cp .env.example .env
```

Edit the .env file:

Open the .env file and configure the settings to match your local environment. By default, Sail uses a MySQL Docker container, so ensure that the database configuration is correct:

```env
DB_CONNECTION=pgsql
DB_HOST=pgsql
DB_PORT=5432
DB_DATABASE=your_database_name
DB_USERNAME=your_user_name
DB_PASSWORD=your_password
```

### Step 4: Generate Application Key

Run the following command to generate a new application key:

```bash
./vendor/bin/sail artisan key:generate
```

This command will generate a new key and add it to your .env file.

### Step 5: Build and Start Docker Containers

Run the following command to build and start the application and database containers using Sail (Laravel's Docker environment):

```bash
./vendor/bin/sail up
```

This will start the Laravel application, MySQL database, and other required services in Docker containers.

### Step 6: Run Migrations

Create and migrate the database by running:

```bash
./vendor/bin/sail artisan migrate
```

This will set up the required database tables.

### Step 7: Seed the Database

To populate the database with default data (like users), run the following seeder command:

```bash
./vendor/bin/sail artisan db:seed --class=UserSeeder
```

This will insert default users (as specified in the UserSeeder class) into the database.

### Step 8: Build and Run the Frontend

Build frontend assets:

Run the following command to build the Vue 3 frontend assets:

```bash
./vendor/bin/sail npm run dev
```

This will compile the assets and make them available to the application.

### Step 9: Access the Application

Once the application is up and running, you can access the LMS admin panel in your browser:

Troubleshooting
If you encounter issues with Docker or Sail, ensure that Docker is running correctly on your system and try restarting the containers by running ./vendor/bin/sail down followed by ./vendor/bin/sail up.
If you face issues with migrations or seeders, check the .env file to ensure your database configuration matches the Docker container setup.
If you're having issues with frontend compilation, ensure that you have Node.js and npm installed correctly.
Additional Notes
For any additional configurations or customizations, refer to the Laravel documentation.
If you need to customize the user roles and permissions, look into the UserSeeder and other related classes for adjusting default data.

```

```
