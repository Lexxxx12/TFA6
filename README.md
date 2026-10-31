# SariPOS From Arrays to Eloquent

SariPOS TFA6 continues the Laravel 13 POS application from TFA5. The four-page design is retained, while customer and staff directories now retrieve persisted records through Eloquent models instead of controller arrays. Six customers and six users are supplied by the seeder.

## Local setup

Requirements: PHP 8.3+ with PDO SQLite (or PDO MySQL), Composer, Node.js 22+, and npm. Use PHP 8.4+ to run the included PHPUnit 12 development tools.

```bash
composer install
cp .env.example .env
php artisan key:generate
php -r "file_exists('database/database.sqlite') || touch('database/database.sqlite');"
php artisan migrate --seed
npm ci
npm run build
php artisan serve
```

Open http://127.0.0.1:8000. SQLite is the default so the project runs without a separate database server. The migrations also support MySQL: create an empty `saripos_tfa6` database, then configure `.env` before running the migrations:

```dotenv
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=saripos_tfa6
DB_USERNAME=root
DB_PASSWORD=
```

After changing database settings, run `php artisan config:clear` and `php artisan migrate --seed`.

## Database schema

The two application tables match TFA2's field names, lengths, nullability, and unique username constraint. Both use an auto-incrementing unsigned integer ID and a required `created_at` datetime.

| Table | Fields |
| --- | --- |
| `customers` | `id`, `full_name` varchar(100), `email` varchar(100), nullable `phone` varchar(20), `created_at` |
| `users` | `id`, unique `username` varchar(50), `full_name` varchar(100), `created_at` |

`Customer` and `User` extend Eloquent `Model`; `UPDATED_AT = null` supports the required schema without an `updated_at` field. User records are directory entries; this activity does not provide authentication. Laravel's supporting cache, job, password-reset, and session tables remain in the skeleton.

This is a separate TFA6 project intended for a new database. The users creation migration defines the TFA2 schema directly; do not run this project's migrations against an existing TFA5 or authentication database. TFA5's original project and deployment remain separate.

`DatabaseSeeder` calls `CustomerStaffSeeder`. Re-running `php artisan db:seed` adds missing sample entries without duplicating them, resetting creation dates, or overwriting edited records. Customer samples are matched by email; staff samples by username. The seeder contains fictional directory data and no passwords.

## Pages and source files

| Route | Data source |
| --- | --- |
| `/` | Eloquent customer and user counts |
| `/about` | Project overview |
| `/customers` | `CustomerController` → `Customer::query()->orderBy('id')->get()` → `customers/index.blade.php` |
| `/users` | `UserController` → `User::query()->orderBy('id')->get()` → `users/index.blade.php` |

Migrations are in `database/migrations`; models in `app/Models`; sample data in `database/seeders/CustomerStaffSeeder.php`. Blade templates retain the navy, coral, and teal TFA5 layout, display empty states, escape record values, and handle a missing phone number. Registration dates and user IDs replace TFA5's status and role columns because status and role are absent from the required schema.

## Verification

```bash
php artisan test --compact
vendor/bin/pint
npm run build
php artisan route:list --except-vendor
```

Feature tests cover all four pages, all seeded records, records created and edited in the database, nullable phones, empty directories, live homepage counts, repeatable seeding, and the unique username constraint.

## Render deployment

Deploy `render.yaml` as a Render Blueprint or create a free Docker web service from this repository. The Docker image installs PDO MySQL and SQLite, builds frontend assets, installs production Composer dependencies, and runs `docker-entrypoint.sh`. Startup creates the SQLite file if absent, runs migrations and the repeatable seeder, caches configuration/routes/views, and starts Laravel on Render's port. No `migrate:fresh` or table truncation is used.

The free Render service uses an ephemeral filesystem: its demo database is recreated and seeded after a redeploy or instance replacement. For durable storage, configure an external MySQL database using the `DB_*` environment variables and remove the SQLite `DB_DATABASE` value, or use a persistent disk on a plan that supports it. Set a stable `APP_KEY` for persistent sessions; when omitted, the demo container generates one on startup. `APP_DEBUG=false` is configured for production.

## Assessment checklist

- Customers and users migrations match the TFA2 schema.
- Six realistic sample records exist in each table.
- `Customer` and `User` are Eloquent models.
- Both directory controllers query their models.
- Blade pages show database records using the existing design.
- Raw source, migrations, seeders, setup instructions, and deployment configuration are included.

Framework references: [Migrations](https://laravel.com/docs/13.x/migrations), [Eloquent](https://laravel.com/docs/13.x/eloquent), [Seeding](https://laravel.com/docs/13.x/seeding).
