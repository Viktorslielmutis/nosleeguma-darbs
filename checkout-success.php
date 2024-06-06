<?php
// Include the database connection file
include "db.php";

// Start the session
session_start();

// Check if the required parameters are set in the URL
if (isset($_GET['id']) && isset($_GET['cena']) && isset($_GET['virsraksts'])) {
    // Assign values from $_GET to variables
    $product_id = $_GET['id'];
    $product_price = $_GET['cena']; 
    $product_name = $_GET['virsraksts']; // No need to decode as it's already URL encoded
} else {
    // Redirect if parameters are missing
    echo "Produkta informacija ir pazudusi";
    exit;
}

// Check if the database connection is available
if (!isset($conn)) {
    echo "Nav savienojums ar datubaazi";
    exit;
}

// Mark the product as purchased by deleting it from the database
$sql = "DELETE FROM products WHERE product_id = ?";
if ($stmt = $conn->prepare($sql)) {
    // Bind variables to the prepared statement as parameters
    $stmt->bind_param("i", $product_id);

    // Attempt to execute the prepared statement
    if ($stmt->execute()) {
        // Product successfully removed from the database
        echo "";
    } else {
        // Error in deletion
        echo "";
    }

    // Close statement
    $stmt->close();
} else {
    // Error in SQL statement
    echo "";
}

// Close connection
$conn->close();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/style.css">
    <title>checkout</title>
</head>
<body>
    
    <div class="checkout">
        <div class="checkout-teksts">
            Sludinājums ir veiksmīgi nopirkts.
        </div>

        <a href="home.php" class="checkout-poga">Atgriezties atpakaļ</a>

    </div>

</body>
</html>