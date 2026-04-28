# karhu-skeleton

Starter app template for the [karhu](https://github.com/bjornbasar/karhu) PHP microframework. Boots a working app with one HTTP route and one CLI command — meant to be `composer create-project`'d and edited.

## Quick start

```bash
composer create-project bjornbasar/karhu-skeleton myapp
cd myapp
composer serve         # http://localhost:8080
```

You'll see the `HomeController` rendering at `/`. Try the CLI too:

```bash
bin/karhu hello YourName
```

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
   use Karhu\Http\Response;

   final class GreetController {
       #[Route('GET', '/greet/{name}')]
       public function greet(string $name): Response {
           return Response::json(['hello' => $name]);
       }
   }
   ```

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
