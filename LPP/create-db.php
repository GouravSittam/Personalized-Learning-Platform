<?php

$dbPath = __DIR__ . '/database/database.sqlite';

// Create the database directory if it doesn't exist
if (!is_dir(__DIR__ . '/database')) {
    mkdir(__DIR__ . '/database', 0755, true);
}

// Remove existing database file if it exists
if (file_exists($dbPath)) {
    unlink($dbPath);
}

// Create and initialize the SQLite database
$db = new PDO("sqlite:" . $dbPath);
$db->exec('PRAGMA foreign_keys = ON;');

// Set proper permissions
chmod($dbPath, 0666);

echo "Database file created and initialized at: " . $dbPath . "\n"; 