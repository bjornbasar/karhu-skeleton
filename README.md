# karhu-skeleton

Starter app template for the [karhu](https://github.com/bjornbasar/karhu) PHP microframework. Boots a working app with one HTTP route and one CLI command — meant to be cloned and edited.

## Quick start

> **This template is not on Packagist**, so `composer create-project bjornbasar/karhu-skeleton`
> fails with a package-not-found error. Clone it instead.

```bash
git clone https://github.com/bjornbasar/karhu-skeleton.git myapp
cd myapp
rm -rf .git
composer install
composer serve         # http://localhost:8080
```

You'll see the `HomeController` rendering at `/`. Try the CLI too:

```bash
vendor/bin/karhu hello --name=YourName
# Hello, YourName!
```

Two notes on that command. `HelloCommand` reads `$args['name']`, so the value must be passed as
`--name=…` — a bare `karhu hello YourName` lands in `$args['0']` and prints `Hello, world!`.
And the `vendor/bin/karhu` shim only exists from karhu **v0.1.5**; on v0.1.4 run
`php vendor/bjornbasar/karhu/bin/karhu hello --name=YourName`.

## What you get

```
karhu-skeleton/
├── app/
│   ├── Commands/HelloCommand.php       # #[Command] CLI sample
│   └── Controllers/HomeController.php  # #[Route] HTTP sample
├── config/
│   ├── commands.php                    # CLI command registry
│   └── controllers.php                 # Controller registry (route scan input)
├── public/index.php                    # Front controller
├── docs/deployment/                    # Reference deployment notes
└── composer.json
```

The front controller is three lines:

```php
$app = new Karhu\App();
$app->router()->scanControllers(require __DIR__ . '/../config/controllers.php');
$app->run();
```

karhu reads `#[Route]` attributes off the registered controllers — no YAML, no closures.

## Add a route

1. Drop a controller into `app/Controllers/`:

   ```php
   namespace App\Controllers;

   use Karhu\Attributes\Route;
   use Karhu\Http\Request;
   use Karhu\Http\Response;

   final class GreetController {
       #[Route('/greet/{name}', methods: ['GET'])]
       public function greet(Request $request): Response {
           return (new Response())->json(['hello' => $request->routeParams()['name']]);
       }
   }
   ```

   Three things are easy to guess wrong here: the **path is the first argument** to
   `#[Route]` (`methods` is a named argument after it), handlers receive the **`Request`**
   rather than unpacked route parameters, and **`json()` is an instance method** on
   `Response`, not a static one.

2. Register it in `config/controllers.php`:

   ```php
   return [
       App\Controllers\HomeController::class,
       App\Controllers\GreetController::class,
   ];
   ```

That's it. Same shape for `#[Command]` CLI handlers in `config/commands.php`.

## Tests

```bash
composer test          # PHPUnit
```

## Documentation

- [DOCS.md](DOCS.md) — design decisions, structure, deployment notes
- [karhu](https://github.com/bjornbasar/karhu) — framework reference
- [istrbuddy](https://github.com/bjornbasar/istrbuddy) — full example app built on top of this skeleton

## License

MIT
