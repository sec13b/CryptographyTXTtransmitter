<?php
    define('USER', 'root');
    define('PASSWORD', '');
    define('HOST', 'localhost');
    define('DATABASE', 'across_networks');
    try {
        $connection = new PDO("mysql:host=".HOST.";dbname=".DATABASE, USER, PASSWORD);
    } catch (PDOException $e) {
        exit("Error: " . $e->getMessage());
    }
