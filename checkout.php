<?php
include "db.php";
require __DIR__ . "/vendor/autoload.php";

$stripe_secret_key = "sk_test_51PMEHE00GEuik9hn1ybibM3NGQ2ScYTxIDYfYCCeMr1jrkJ0HkpGD31ROJiOkCPkdlaQQyXdofCRWO3dDs0Yjhsp00KnMsAZY5";

\Stripe\Stripe::setApiKey($stripe_secret_key);

session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
}

// Check if the required parameters are set in the URL
if (isset($_GET['id']) && isset($_GET['cena']) && isset($_GET['virsraksts'])) {
    // Assign values from $_GET to variables
    $product_id = $_GET['id'];
    $product_price = $_GET['cena']; 
    $product_name = $_GET['virsraksts']; // No need to decode as it's already URL encoded
} else {
    // Redirect if parameters are missing
    echo "Error: Product details are missing.";
    exit;
}

// Define the base URL for your local environment (using default port 80)
$base_url = "https://lauris.kvd.lv/";

// Construct full URLs
$success_url = $base_url . "/checkout-success.php?status=success&id=$product_id&cena=$product_price&virsraksts=" . urlencode($product_name);
$cancel_url = $base_url . "/";

// Debug output (optional, can be removed in production)
echo "Success URL: $success_url<br>";
echo "Cancel URL: $cancel_url<br>";

try {
    $checkout_session = \Stripe\Checkout\Session::create([
        "payment_method_types" => ["card"],
        "line_items" => [[
            "price_data" => [
                "currency" => "eur",
                "unit_amount" => $product_price * 100,
                "product_data" => [
                    "name" => $product_name
                ]
            ],
            "quantity" => 1,
        ]],
        "mode" => "payment",
        "success_url" => $success_url,
        "cancel_url" => $cancel_url,
        "locale" => "auto",
    ]);

    // Debug output to verify session URL
    echo "Checkout Session URL: " . $checkout_session->url . "<br>";

    // Redirect to the checkout session URL
    header("Location: " . $checkout_session->url);
    exit;
} catch (\Stripe\Exception\ApiErrorException $e) {
    // Handle Stripe API errors
    echo "Error: " . $e->getMessage();
    exit;
} catch (Exception $e) {
    // Handle other exceptions
    echo "Error: " . $e->getMessage();
    exit;
}
?>
