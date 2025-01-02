<?php
header('Content-Type: application/json');

// Database credentials
$hostname = "db"; // Usually "localhost"
$username = "root";
$password = "rootpassword";
$database = "mydatabase";

try {
    $conn = new mysqli($hostname, $username, $password, $database);

    // Check for connection errors
    if ($conn->connect_error) {
        throw new Exception("Connection failed: " . $connection->connect_error);
    }

    $response = ["status" => 200, "message" => "Connected successfully to the database."];

    echo json_encode($response);
} catch (Exception $e) {

    $response = ["status" => 500, "message" => "Error: " . $e->getMessage()];

    echo json_encode($response);
}
