# karhu-skeleton — Project Documentation

**Version:** 0.1.0 | **License:** MIT | **PHP:** >=8.3

Starter template for the [karhu](https://github.com/bjornbasar/karhu) PHP microframework.

---

## Tech Stack

| Component | Technology |
|-----------|-----------|
| Framework | karhu 0.1 (zero-dep PHP microframework) |
| Language | PHP 8.3+ |
| Testing | PHPUnit 11 |
| Server (dev) | `php -S` via `composer serve` |

No DB, no view engine, no auth out of the box — pull in [karhu-db](https://github.com/bjornbasar/karhu-db), [karhu-view](https://github.com/bjornbasar/karhu-view), or [karhu-queue](https://github.com/bjornbasar/karhu-queue) as needed.

---

## Directory Structure

```
karhu-skeleton/
├── app/
│   ├── Commands/
│   │   └── HelloCommand.php         # #[Command('hello')] sample
│   └── Controllers/
│       └── HomeController.php       # #[Route('GET', '/')] sample
├── config/
│   ├── commands.php                 # Array of CLI command class names
│   └── controllers.php              # Array of controller class names (route scan input)
├── public/
│   └── index.php                    # Front controller (3 lines: bootstrap + scan + run)
├── docs/
│   └── deployment/                  # Reference deployment notes
└── composer.json
```

---

## Key Design Decisions

- **Zero magic** — the front controller is three lines. Everything that happens is a method call you can step through.
- **Explicit registry** — `config/controllers.php` and `config/commands.php` are arrays of class names. No directory globbing, no autodiscovery surprise. Adding a route means adding the class to the array.
- **Attributes only** — routes via `#[Route(...)]`, CLI commands via `#[Command(...)]`. Closures-as-routes are not exposed.
- **No DB by default** — the skeleton stays pure framework. Pull in karhu-db when you want one.
- **Single autoload root** — `App\` PSR-4 maps to `app/`. Tests live in `tests/` under `App\Tests\`.

---

## Adding things

| Want to add… | Do this |
|---|---|
| HTTP route | Drop a controller in `app/Controllers/` with `#[Route]`, list it in `config/controllers.php` |
| CLI command | Drop a class in `app/Commands/` with `#[Command]`, list it in `config/commands.php` |
| Database | `composer require bjornbasar/karhu-db`, register `Connection` in the container |
| Templates | `composer require bjornbasar/karhu-view twig/twig`, bind `ViewInterface` in the container |
| Background jobs | `composer require bjornbasar/karhu-queue` (and `karhu-db` for the default driver) |

---

## Development

```bash
composer install
composer serve           # php -S localhost:8080 -t public
composer test            # PHPUnit
```

---

## Deployment

See [`docs/deployment/`](docs/deployment/) for reference notes (nginx + php-fpm, Docker, route cache).

Production build step before first request:

```bash
bin/karhu route:cache    # compile routes for cold-start performance
```

---

## Related Repos

| Repo | Purpose |
|------|---------|
| [karhu](https://github.com/bjornbasar/karhu) | Framework |
| [karhu-db](https://github.com/bjornbasar/karhu-db) | DB access |
| [karhu-view](https://github.com/bjornbasar/karhu-view) | Template engine bridge |
| [karhu-queue](https://github.com/bjornbasar/karhu-queue) | Queue/worker |
| [istrbuddy](https://github.com/bjornbasar/istrbuddy) | Full example app on top of this skeleton |
