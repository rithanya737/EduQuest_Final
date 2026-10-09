<?php
// EduQuest - MySQL connection
// MySQL server: existing local MySQL/MariaDB on port 3306

$host = "127.0.0.1";
$port = 3306;
$dbname = "eduquest";
$username = "eduquest";
$password = "eduquest";

try {
    $pdo = new PDO(
        "mysql:host=$host;port=$port;dbname=$dbname;charset=utf8mb4",
        $username,
        $password,
        array(
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false
        )
    );
} catch (PDOException $e) {
    http_response_code(500);
    header("Content-Type: application/json; charset=utf-8");
    echo json_encode(array(
        "ok" => false,
        "error" => "Database connection failed. Check backend/config/db.php and make sure MySQL is running."
    ));
    exit;
}
?>
