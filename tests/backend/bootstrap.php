<?php

use Dotenv\Dotenv;

require_once dirname(__DIR__, 2) . '/vendor/autoload.php';

$dotenv = Dotenv::createImmutable(dirname(__DIR__, 2));
$dotenv->safeLoad();
