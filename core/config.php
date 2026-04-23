<?php

$env = parse_ini_file(dirname(__DIR__) . '/.env');

if (!$env) {
    die("Can't find .env file.");
}

// ==========================================
// 1. Paths & URLs
// ==========================================

// Server/Directory Path
// (like: C:\xampp\htdocs\X-Core\)
define('ROOT_PATH', dirname(__DIR__) . DIRECTORY_SEPARATOR);

// Base URL

define('BASE_URL', 'http://localhost/7X_Hub_Blog/');


// ==========================================
// 2. Database Settings
// ==========================================
define('DB_HOST', $env['DB_HOST']);
define('DB_NAME', $env['DB_NAME']);
define('DB_USER', $env['DB_USER']);
define('DB_PASS', $env['DB_PASS']); 
?>