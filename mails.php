<?php
// Database configuration
$host = "db"; // Docker service name
$user = "root";
$pass = "rootpassword";
$dbname = "email_collector";

try {
    // Create connection
    $conn = new mysqli($host, $user, $pass, $dbname);

    // Check connection
    if ($conn->connect_error) {
        throw new Exception("Connection failed: " . $conn->connect_error);
    }

    // Fetch all emails
    $result = $conn->query("SELECT * FROM emails ORDER BY created_at DESC");

    if (!$result) {
        throw new Exception("Query failed: " . $conn->error);
    }
} catch (Exception $e) {
    $error = $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Collected Emails</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            margin: 0;
            padding: 20px;
            background-color: #f5f5f5;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            background: white;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            color: #333;
            border-bottom: 1px solid #eee;
            padding-bottom: 10px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #f9f9f9;
        }

        .error {
            color: red;
            padding: 10px;
            background: #ffeeee;
            border: 1px solid #ffcccc;
            border-radius: 4px;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Collected Emails</h1>

        <?php if (isset($error)): ?>
            <div class="error"><?php echo htmlspecialchars($error); ?></div>
        <?php elseif ($result->num_rows > 0): ?>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Email Address</th>
                        <th>Date Collected</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['id']); ?></td>
                            <td><?php echo htmlspecialchars($row['email']); ?></td>
                            <td><?php echo htmlspecialchars($row['created_at']); ?></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
            <p>Total: <?php echo $result->num_rows; ?> emails collected</p>
        <?php else: ?>
            <p>No emails have been collected yet.</p>
        <?php endif; ?>

        <p><a href="/">Back to Email Collector</a></p>
    </div>

    <?php
    // Close connection if it exists
    if (isset($conn)) {
        $conn->close();
    }
    ?>
</body>

</html>