<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete_order'])) {
    include 'db.php'; // Your database connection file

    $orderId = $conn->real_escape_string($_POST['order_id']);

    // Prepare the DELETE statement to prevent SQL injection
    $stmt = $conn->prepare("DELETE FROM confirmed_order WHERE id = ?");
    $stmt->bind_param("i", $orderId); // "i" indicates that the variable type is integer

    // Execute the statement
    if ($stmt->execute()) {
        echo "Order deleted successfully.";
        // Redirect back to the orders page
        header("Location: orders.php");
        exit();
    } else {
        echo "Error deleting record: " . $conn->error;
    }

    // Close the statement and the connection
    $stmt->close();
    $conn->close();
} else {
    // Not a POST request or missing expected POST data
    echo "Invalid request.";
}
?>