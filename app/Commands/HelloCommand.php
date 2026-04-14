<?php

declare(strict_types=1);

namespace App\Commands;

use Karhu\Attributes\Command;

final class HelloCommand
{
    /**
     * @param array<string, string|true> $args
     */
    #[Command('hello', 'Say hello')]
    public function handle(array $args): int
    {
        $name = is_string($args['name'] ?? null) ? $args['name'] : 'world';

        fwrite(\STDOUT, "Hello, {$name}!\n");
        return 0;
    }
}
