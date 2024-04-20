<?php
// Assuming you've already set up your database connection parameters
$host = 'localhost'; // or your host
$dbname = 'food-order-db';
$username = 'root';
$password = 'admin';

// Create a connection to the database
$conn = new mysqli($host, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve data from the request
$data = json_decode(file_get_contents("php://input"), true);
$cartItems = $data['cartItems'];
$totalAmount = $data['totalAmount'];

// Generate a unique order number (this is a simple approach)
$orderNumber = uniqid('Order');

// Convert cart items array to JSON for storage
$itemDetails = json_encode($cartItems);

// Prepare SQL statement to insert the order into the init_order table
$stmt = $conn->prepare("INSERT INTO init_order (order_number, item_details, total_price) VALUES (?, ?, ?)");
$stmt->bind_param("ssd", $orderNumber, $itemDetails, $totalAmount);

// Execute the statement and check if it was successful
if ($stmt->execute()) {
    echo json_encode(["success" => true, "orderNumber" => $orderNumber]);
} else {
    // If execution failed, return an error
    echo json_encode(["success" => false, "message" => "Failed to store order details."]);
}

// Close statement and connection
$stmt->close();
$conn->close();
?>