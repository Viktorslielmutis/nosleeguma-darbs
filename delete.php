<?php
include "db.php";

$id = $_GET['id'];

$del = mysqli_query($conn, "DELETE FROM products WHERE product_id = '$id'");

if ($del) {
    // Redirect user after deleting record
    header("Location: profile.php");
    exit; // Make sure to stop script execution after sending the header
} else {
    echo "Error deleting record: " . mysqli_error($conn);
}
?>