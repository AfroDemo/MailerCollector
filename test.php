<?php
$conn = new mysqli("db", "root", "rootpassword", "email_collector");
if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);
echo "Connected successfully!";
$conn->close();