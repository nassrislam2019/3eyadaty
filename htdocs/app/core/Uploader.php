<?php
class Uploader
{
    public static function upload(array $file, string $dir, array $allowed, int $maxMb): array
    {
        if ($file['error'] !== UPLOAD_ERR_OK) {
            return ['error' => 'حدث خطأ أثناء رفع الملف'];
        }
        $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
        if (!in_array($ext, $allowed, true)) {
            return ['error' => 'امتداد الملف غير مسموح'];
        }
        $maxBytes = $maxMb * 1024 * 1024;
        if ($file['size'] > $maxBytes) {
            return ['error' => 'حجم الملف كبير'];
        }
        if (!is_dir($dir)) {
            mkdir($dir, 0755, true);
        }
        $name = bin2hex(random_bytes(16)) . '.' . $ext;
        $path = rtrim($dir, '/') . '/' . $name;
        if (!move_uploaded_file($file['tmp_name'], $path)) {
            return ['error' => 'فشل حفظ الملف'];
        }
        return ['path' => $path, 'name' => $name];
    }
}
