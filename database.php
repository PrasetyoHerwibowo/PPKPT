<?php

$env = require 'env.php';

return [
    'host' => $env['DB_HOST'],
    'database' => $env['DB_NAME'],
    'username' => $env['DB_USER'],
    'password' => $env['DB_PASS']
];