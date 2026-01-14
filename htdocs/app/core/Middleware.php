<?php
class Middleware
{
    public static function auth(array $roles = []): bool
    {
        if (!Auth::check()) {
            Helpers::flash('error', 'يرجى تسجيل الدخول أولاً');
            Helpers::redirect('index.php?route=login');
            return false;
        }
        if (!empty($roles)) {
            $userRole = Auth::user()['role'] ?? '';
            if (!in_array($userRole, $roles, true)) {
                Response::view('errors/403', ['title' => '403']);
                return false;
            }
        }
        return true;
    }
}
