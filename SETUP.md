# Shipping App – Git & Setup Guide

This document explains how to **prepare the project for Git**, push it to a remote, and **run it on Windows 10** after cloning.

---

## Part 1: Make it ready for Git (on your current machine, e.g. Mac)

Do this once so you can push the repo and clone it elsewhere.

### 1. Initialize Git and create the first commit

From the project root (`shipping-app`):

```bash
git init
git add .
git status
```

Check that **no** `.env` file is staged (it must be ignored). If you see `vendor/` or `node_modules/` listed, ensure `.gitignore` is in place and run:

```bash
git reset HEAD vendor node_modules .env 2>nul || true
git add .
git status
```

Then commit:

```bash
git commit -m "Initial commit: Laravel shipping app with Breeze and DataTables"
```

### 2. Push to a remote (GitHub, GitLab, etc.)

Create a **new empty repository** on GitHub/GitLab (no README, no .gitignore). Then:

```bash
git remote add origin https://github.com/YOUR_USERNAME/shipping-app.git
git branch -M main
git push -u origin main
```

Use your actual repository URL and branch name if different.

---

## Part 2: Ready setup on Windows 10 – Laravel Herd (one installer)

**Laravel Herd** is a single download for Windows 10 that gives you PHP, Composer, Node/npm, nginx, and the Laravel installer. No need to install PHP, Composer, or Node separately.

### 1. Download and install Herd

- **Download:** [herd.laravel.com/download/windows](https://herd.laravel.com/download/latest/windows) or [herd.laravel.com/windows](https://herd.laravel.com/windows)
- **Requirements:** Windows 10 or higher, administrator rights for installation
- Run the installer. Herd will set up PHP (multiple versions), Composer, Node.js (via nvm), nginx, and Expose. Use a **new terminal** after installation so `php`, `composer`, and `npm` are in your PATH.

### 2. Clone and open the project

```bash
git clone https://github.com/YOUR_USERNAME/shipping-app.git
cd shipping-app
```

### 3. Configure and install (same as below)

```bash
copy .env.example .env
php artisan key:generate
composer install
npm install
npm run build
type nul > database\database.sqlite
php artisan migrate
php artisan storage:link
```

### 4. Run the app with Herd

- **Option A:** In Herd’s UI, add this project folder as a site. Herd will serve it at something like `http://shipping-app.test`.
- **Option B:** From the project folder run `php artisan serve` and open **http://127.0.0.1:8000**.

That’s it. Herd takes care of PHP, npm, and the rest; you only install Herd and Git, then run the commands above.

---

## Part 3: Manual setup on Windows 10 (without Herd)

If you don’t use Herd, install each tool yourself and follow these steps.

### Prerequisites (install if missing)

| Tool      | Purpose           | Install / Check |
|-----------|-------------------|------------------|
| **Git**   | Clone and version control | [git-scm.com](https://git-scm.com/download/win) – use “Git Bash” or “Windows Terminal” for the commands below. |
| **PHP 8.2+** | Laravel backend   | [windows.php.net](https://windows.php.net/download/) or use [Laragon](https://laragon.org/), [XAMPP](https://www.apachefriends.org/), or [WSL2](https://docs.microsoft.com/en-us/windows/wsl/install). Run `php -v`. |
| **Composer** | PHP dependencies | [getcomposer.org](https://getcomposer.org/download/). Run `composer -V`. |
| **Node.js 18+** | Front-end build (Vite) | [nodejs.org](https://nodejs.org/). Run `node -v` and `npm -v`. |
| **SQLite** (optional) | Default DB in this app | Often included with PHP. For MySQL/PostgreSQL, install and use that instead. |

### Steps on Windows 10

1. **Clone the repository**

   ```bash
   git clone https://github.com/YOUR_USERNAME/shipping-app.git
   cd shipping-app
   ```

2. **Copy environment file and generate key**

   ```bash
   copy .env.example .env
   php artisan key:generate
   ```

3. **Install PHP dependencies**

   ```bash
   composer install
   ```

4. **Install Node dependencies and build assets**

   ```bash
   npm install
   npm run build
   ```

5. **Database (SQLite by default)**

   - **SQLite:** Create an empty file as the database (Laravel will use it):

     ```bash
     type nul > database\database.sqlite
     ```

   - **Or MySQL/PostgreSQL:** Edit `.env` and set `DB_CONNECTION`, `DB_HOST`, `DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD` (and port if needed). Leave `DB_CONNECTION=sqlite` and other DB_* commented if you use SQLite.

6. **Run migrations**

   ```bash
   php artisan migrate
   ```

7. **Create storage link (for public storage)**

   ```bash
   php artisan storage:link
   ```

8. **Start the application**

   ```bash
   php artisan serve
   ```

   Open **http://127.0.0.1:8000** in your browser.

### Optional: development with hot reload

- **Vite (front-end):** In a second terminal run `npm run dev` and keep it open while using `php artisan serve` in the first.
- **Sail (Docker):** If you use Docker on Windows, you can use Laravel Sail instead of local PHP/Node; see [Laravel Sail docs](https://laravel.com/docs/sail).

### Troubleshooting on Windows

- **“php” or “composer” not found:** Add PHP and Composer to the system **PATH** (or use full paths).
- **“npm” not found:** Install Node.js and restart the terminal.
- **Permission or path errors:** Run terminal as Administrator if needed, or use a path without spaces (e.g. `C:\Projects\shipping-app`).
- **SQLite “database not found”:** Ensure `database\database.sqlite` exists and that `DB_CONNECTION=sqlite` in `.env` (other DB_* can be commented).

---

## Summary checklist

**On your current machine (ready for Git):**  
`git init` → `git add .` → `git commit` → `git remote add origin <url>` → `git push -u origin main`

**On Windows 10 with Laravel Herd (easiest):**  
Install [Laravel Herd](https://herd.laravel.com/windows) → Clone repo → `copy .env.example .env` → `php artisan key:generate` → `composer install` → `npm install` → `npm run build` → `type nul > database\database.sqlite` → `php artisan migrate` → `php artisan storage:link` → open in Herd or `php artisan serve`

**On Windows 10 without Herd (manual):**  
Clone → install PHP, Composer, Node yourself → same commands as above → `php artisan serve`
