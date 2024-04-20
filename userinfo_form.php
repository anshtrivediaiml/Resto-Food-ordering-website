<?php
// Retrieve the order number from the query string

$orderNumber = isset($_GET['orderNumber']) ? $_GET['orderNumber'] : 'Unknown Order Number';
$totalAmount = isset($_GET['totalAmount']) ? $_GET['totalAmount'] : 0;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Information Form</title>
    <link rel="stylesheet" href="login-oage.css" />

</head>

<body>
    <div class="login">
        <h2 style="color:white;">User Information</h2>
        <p style="color:white;">Order Number: <strong><?php echo htmlspecialchars($orderNumber); ?></strong></p>

        <p style="color:white;">Total Amount: <strong><?php echo htmlspecialchars($totalAmount); ?></strong></p>
        <form action="confirm_order.php" method="post">
            <input type="hidden" name="orderNumber" value="<?php echo htmlspecialchars($orderNumber); ?>">
            <div class="form-group">
                <label for="name" style="color:white;">Name:</label>
                <input type="text" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="phone" style="color:white;">Phone Number:</label>
                <input type="text" id="phone" name="phone" required>
            </div>
            <div class="form-group">
                <label for="address" style="color:white;">Address:</label>
                <textarea id="address" name="address" required></textarea>
            </div>
            <input type="hidden" name="orderNumber" value="<?php echo htmlspecialchars($orderNumber); ?>">
            <input type="hidden" name="total_amount" value="<?php echo htmlspecialchars($totalAmount); ?>">
            <button type="submit" class="btn btn-primary btn-block btn-large">Submit</button>
        </form>
    </div>
</body>

</html>