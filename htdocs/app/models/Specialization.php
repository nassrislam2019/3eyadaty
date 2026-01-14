<?php
class Specialization
{
    public static function all(): array
    {
        return DB::conn()->query('SELECT * FROM specializations ORDER BY name')->fetchAll();
    }
}
