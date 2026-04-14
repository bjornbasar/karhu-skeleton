<?php

declare(strict_types=1);

namespace App\Controllers;

use Karhu\Attributes\Route;
use Karhu\Http\Request;
use Karhu\Http\Response;

final class HomeController
{
    #[Route('/', name: 'home')]
    public function index(Request $request): Response
    {
        if ($request->accepts('application/json') && !$request->accepts('text/html')) {
            return (new Response())->json(['message' => 'Hello from karhu!']);
        }

        return (new Response())
            ->withHeader('Content-Type', 'text/html')
            ->withBody('<h1>Hello from karhu!</h1><p>Edit <code>app/Controllers/HomeController.php</code> to get started.</p>');
    }
}
