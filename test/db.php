<?php
//ghazi made a update
// hello ya helo fi menak 3a jelo
?>





<?php
// Database connection
$host = 'localhost'; // Change if your database is hosted elsewhere
$dbname = 'testing';     // Replace with your database name
$username = 'root';  // Replace with your database username
$password = '';      // Replace with your database password

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}
?>
