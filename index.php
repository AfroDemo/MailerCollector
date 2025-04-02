<?php
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "email_collector";

$conn = new mysqli($host, $user, $pass, $dbname);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);

    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $stmt = $conn->prepare("INSERT INTO emails (email) VALUES (?)");
        $stmt->bind_param("s", $email);

        if ($stmt->execute()) {
            echo "Email saved successfully!";
        } else {
            echo "Error: " . $conn->error;
        }
    } else {
        echo "Invalid email address!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email Collection</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h2>Welcome to My Service</h2>
        <p>Enter your email to receive updates:</p>
        <form action="" method="post">
            <input type="email" name="email" required placeholder="Enter your email">
            <button type="submit">Submit</button>
        </form>
    </div>
</body>
</html>
