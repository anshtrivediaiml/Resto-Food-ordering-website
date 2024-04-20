<?php
// Assuming db.php connects to your database and is properly configured
include 'db.php';

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate and sanitize input data
    $orderNumber = $conn->real_escape_string($_POST['orderNumber']);
    $name = $conn->real_escape_string($_POST['name']);
    $phone = $conn->real_escape_string($_POST['phone']);
    $address = $conn->real_escape_string($_POST['address']);
    $totalAmount = $conn->real_escape_string($_POST['total_amount']);

    // Prepare the SQL statement to prevent SQL injection
    $stmt = $conn->prepare("INSERT INTO confirmed_order (order_number, name, phone, address, total_amount) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssd", $orderNumber, $name, $phone, $address, $totalAmount);

    // Execute the statement and check if it was successful
    if ($stmt->execute()) {
        echo "Order confirmed successfully. Thank you!";
        // Here, you can redirect the user or provide a link back to the homepage or order status page
        header('Location: index.html'); // Example redirection
    } else {
        echo "There was an error confirming your order. Please try again.";
    }

    // Close the statement and the connection
    $stmt->close();
    $conn->close();
} else {
    // Not a POST request, handle the error or redirect
    echo "Invalid request.";
}
?>