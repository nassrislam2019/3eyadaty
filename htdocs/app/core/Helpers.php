<?php
class Helpers
{
    public static function e(string $value): string
    {
        return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
    }

    public static function baseUrl(string $path = ''): string
    {
        $config = require __DIR__ . '/../../config/app.php';
        $base = rtrim($config['base_url'], '/');
        if ($base === '') {
            $scheme = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http';
            $host = $_SERVER['HTTP_HOST'] ?? 'localhost';
            $script = rtrim(str_replace('index.php', '', $_SERVER['SCRIPT_NAME'] ?? ''), '/');
            $base = $scheme . '://' . $host . $script;
        }
        return rtrim($base, '/') . '/' . ltrim($path, '/');
    }

    public static function redirect(string $path): void
    {
        header('Location: ' . self::baseUrl($path));
        exit;
    }

    public static function session(string $key, $default = null)
    {
        return $_SESSION[$key] ?? $default;
    }

    public static function flash(string $key, string $message = null)
    {
        if ($message !== null) {
            $_SESSION['flash'][$key] = $message;
            return null;
        }
        $value = $_SESSION['flash'][$key] ?? null;
        unset($_SESSION['flash'][$key]);
        return $value;
    }
}
