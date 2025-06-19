<?php

$host = 'db'; // this is the service name from docker-compose.yml
$port = '5432';
$db   = 'mydatabase';
$user = 'myuser';
$pass = 'secret';

try {
    $pdo = new PDO("pgsql:host=$host;port=$port;dbname=$db", $user, $pass);
    echo "✅ Connected to PostgreSQL successfully!" . PHP_EOL;

    // Optional: create table and insert data
    $pdo->exec("CREATE TABLE IF NOT EXISTS greetings (message TEXT)");
    $pdo->exec("INSERT INTO greetings (message) VALUES ('Hello from Docker!')");
    
    foreach ($pdo->query("SELECT * FROM greetings") as $row) {
        echo "Message: " . $row['message'] . PHP_EOL;
    }
} catch (PDOException $e) {
    echo "❌ Connection failed: " . $e->getMessage() . PHP_EOL;
}

file_put_contents('/var/log/myapp/app.log', "Log entry at " . date('c') . PHP_EOL, FILE_APPEND);