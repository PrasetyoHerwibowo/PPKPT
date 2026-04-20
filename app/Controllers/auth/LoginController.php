<?php
define('BASE_URL', 'http://localhost:8000');
class Auth
{
    public static function login($username, $password)
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if ($username === "admin" && $password === "12345") {

            $_SESSION['admin'] = true;

            header("Location: " . BASE_URL . "/views/dashboard/index.php");
            exit;
        }

        header("Location: " . BASE_URL . "/views/login.php?error=1");
        exit;
    }

    public static function checkAdmin()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['admin'])) {
            header("Location: " . BASE_URL . "/views/login.php");
            exit;
        }
    }

    public static function logout()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        session_destroy();

        header("Location: " . BASE_URL . "/views/login.php");
        exit;
    }
}
?>