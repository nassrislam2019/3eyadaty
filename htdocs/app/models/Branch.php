<?php
class Branch
{
    public static function all(): array
    {
        return DB::conn()->query('SELECT * FROM branches ORDER BY name')->fetchAll();
    }
}
