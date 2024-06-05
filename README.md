# BudgetBuddy - An Advanced Expense Tracker System

A simple expense tracker system built with Laravel, designed to help users manage their finances by tracking expenses and setting budgets.

## Installation

1. Clone the repository:
   ```bash
   git clone https://github.com/dongjilo/expense-tracker-system.git [YourDirectoryName]
    ```
2. Navigate to your project directory:
    ```bash
    cd your-project-directory
    ```
3. Install dependencies:
    ```bash
    composer install
    npm install
    ```
4. Create a copy of the `.env-example` and rename it to `.env`:
   ```bash
    cp .env-example .env
   ```
5. Generate Application Key:
   ```bash
    php artisan key:generate
   ```
6. Set up your database credentials and the generated `app_key` in the `.env` file


7. Run the migrations and seed the database:
    ```bash
    php artisan migrate --seed
    ```
## Usage

1. Run the server:
    ```bash
    php artisan serve
    ```
2. Visit `localhost:8000` in your browser
3. Credentials for Budget Buddy: email: `buddy@e.cc` password:`123`

## Screenshots
**Login**
![Login](screenshots/1.png)

**Registration**
![Registration](screenshots/2.png)

**Dashboard**
![Dashboard](screenshots/3.png)
![Dashboard (Dark Mode)](screenshots/4.png)

**Categories**
![Categories](screenshots/5.png)
![Add Categories](screenshots/6.png)

**Expenses**
![Expenses](screenshots/7.png)
![Add Expenses](screenshots/8.png)

**Goals**
![Goals](screenshots/9.png)
![Add Expenses](screenshots/10.png)

**Profile**
![Profile](screenshots/11.png)
![Edit Profile](screenshots/12.png)

