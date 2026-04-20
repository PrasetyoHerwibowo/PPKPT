<?php

require_once __DIR__ . "/LoginController.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    Auth::login($_POST['username'], $_POST['password']);
}