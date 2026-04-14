<?php

declare(strict_types=1);

require __DIR__ . '/../vendor/autoload.php';

$app = new Karhu\App();
$app->router()->scanControllers(require __DIR__ . '/../config/controllers.php');
$app->run();
