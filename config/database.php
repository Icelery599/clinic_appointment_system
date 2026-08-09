<?php

declare(strict_types=1);

final class Database
{
    private const HOST = '127.0.0.1';
    private const DB = 'clinic_system';
    private const USER = 'root';
    private const PASS = '';
    private const CHARSET = 'utf8mb4';

    public static function connection(): PDO
    {
        static $pdo = null;
        if ($pdo instanceof PDO) {
            return $pdo;
        }

        $dsn = sprintf('mysql:host=%s;dbname=%s;charset=%s', self::HOST, self::DB, self::CHARSET);
        $pdo = new PDO($dsn, self::USER, self::PASS, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ]);

        return $pdo;
    }
}
