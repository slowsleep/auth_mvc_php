<?php

$env = parse_ini_file(realpath(__DIR__ . '/../../.env'));
$salt = $env['SECRET_KEY'];

define('SALT', $salt);
define('CLIENT_ID', $env['CLIENT_ID']);
define('REDIRECT_URL', $env['REDIRECT_URL']);
