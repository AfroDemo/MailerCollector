<?php
$max_retries = 10;
$retry_delay = 5;

$host = "db";
$user = "root";
$pass = "rootpassword";
$dbname = "email_collector";

for ($i = 0; $i < $max_retries; $i++) {
    try {
        $conn = new mysqli($host, $user, $pass, $dbname);
        if ($conn->connect_error) {
            throw new Exception("Connection failed: " . $conn->connect_error);
        }
        echo "Database is ready!\n";
        $conn->close();
        exit(0);
    } catch (Exception $e) {
        if ($i === $max_retries - 1) {
            echo "Database not ready after $max_retries attempts\n";
            exit(1);
        }
        sleep($retry_delay);
    }
}
