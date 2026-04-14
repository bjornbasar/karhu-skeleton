<?php

declare(strict_types=1);

/**
 * Register CLI command classes for bin/karhu scanning.
 * The dispatcher discovers #[Command] attributes on public methods.
 */
return [
    App\Commands\HelloCommand::class,
];
