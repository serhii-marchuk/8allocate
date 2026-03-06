<?php

require_once __DIR__ . '/App.php';
$em = require_once __DIR__ . '/bootstrap.php';

$app = new App($em);
$app->handleRequest();
