# MVC Blog Management System

A learning project by **Alp Türkoğlu**, built with plain PHP, MySQL, PDO and Bootstrap 5. The application uses a small custom MVC structure to separate routing, request handling, database access and views.

## Features

- Registration, login and session-based authentication
- User and administrator roles
- Create, edit and delete posts, with draft and published states
- Category management and comments
- Search published posts by title, content or author
- Pagination, dashboard, profile and password changes
- Password hashing, PDO prepared statements and CSRF checks on existing POST forms

## Requirements

- PHP 8.4.1 or newer for the locked PHPUnit development dependencies
- PHP PDO MySQL extension and the extensions required by Composer
- MySQL 8 (the schema uses `utf8mb4_0900_ai_ci`)
- Composer for running the included tests

Bootstrap is loaded from jsDelivr and requires internet access for styling.

## Local setup

1. Clone or download this repository.
2. Create an empty MySQL database named `mvc_blog_system`, then import `mvc_blog_system.sql` using your database tool or:

   ```sh
   mysql -u YOUR_DATABASE_USER -p mvc_blog_system < mvc_blog_system.sql
   ```

3. Configure environment variables in your shell or web-server configuration:

   | Variable | Default / purpose |
   | --- | --- |
   | `DB_HOST` | `127.0.0.1` |
   | `DB_PORT` | `3306` (MAMP commonly uses `8889`) |
   | `DB_NAME` | `mvc_blog_system` |
   | `DB_USER` | `mvc_blog` |
   | `DB_PASSWORD` | Required; your local database password |
   | `APP_BASE_URL` | Empty for a server rooted at `public/`; otherwise the URL path to `public/` |

   Set `DB_PASSWORD` privately in your environment. This project does not automatically load `.env` files. Never commit your local credentials.

4. Start the local development server:

   ```sh
   php -S 127.0.0.1:8000 -t public
   ```

5. Open `http://127.0.0.1:8000` and register a new account.

The schema contains no seeded accounts or content. To try administrator features locally, register an account first and change only that account's `role` to `admin` through your database administration tool. There is no default administrator password.

For Apache or MAMP, configure the document root to `public/` and set the same environment variables in the server configuration. If serving under a subdirectory, set `APP_BASE_URL` to that path (for example `/mvc-blog-management-system/public`). Keep configuration and database files outside the public document root.

## Tests

```sh
composer install
vendor/bin/phpunit tests
```

The four included tests check isolated password hashing, email validation, slug generation and status examples. They do not exercise the controllers, database or full application. All 34 PHP source files passed syntax checks with PHP 8.4.17 from MAMP during publication preparation. The PHPUnit suite and database-backed application flows have not yet been run.

## Structure

```text
app/Controllers/   Request handlers
app/Models/        PDO database operations
app/Views/         PHP templates
config/            Application and environment-based database configuration
core/Router.php    Custom GET/POST router
public/index.php   Front controller and web document root
routes/web.php     Route definitions
storage/           Local runtime files (ignored)
tests/             PHPUnit examples
mvc_blog_system.sql  Schema only
```

## Project status and security scope

This is an educational portfolio project, not a production-ready service. Some state-changing actions (post/category deletion and logout) currently use GET requests without CSRF verification. Session hardening, login throttling, broader validation and integration testing remain areas for improvement before internet deployment.

The publication copy excludes the original database records and password hashes, documented demo passwords, hard-coded database credentials, bundled `vendor/` dependencies, local screenshots, video and macOS metadata. Composer manifests and the lockfile are retained so development dependencies can be restored.
