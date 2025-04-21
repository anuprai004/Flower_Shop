<?php
session_start();
@include 'config.php';

$secret_key = "8gBm/:&EnhH.1/q";

if (!isset($_GET['data'])) {
    echo "Missing response data.";
    exit;
}

// Get and decode base64 response from URL
$decoded = base64_decode($_GET['data']);
$response = json_decode($decoded, true);

// DEBUG (optional)
// echo "
//<pre>"; print_r($response); echo "</pre>";

if (!$response || !isset($response['signature'])) {
    echo "Invalid or incomplete response.";
    exit;
}

// Regenerate the signature string using the same order as `signed_field_names`
$raw_string = "transaction_code={$response['transaction_code']},status={$response['status']},total_amount={$response['total_amount']},transaction_uuid={$response['transaction_uuid']},product_code={$response['product_code']},signed_field_names={$response['signed_field_names']}";

// Recreate signature
$expected_signature = base64_encode(hash_hmac('sha256', $raw_string, $secret_key, true));

// Verify the signature and status
if ($expected_signature === $response['signature'] && $response['status'] === 'COMPLETE') {

    $user_id = $_SESSION['user_id'] ?? 0;
    $name = $_SESSION['checkout_name'] ?? '';
    $number = $_SESSION['checkout_number'] ?? '';
    $email = $_SESSION['checkout_email'] ?? '';
    $address = $_SESSION['checkout_address'] ?? '';
    $total_products = $_SESSION['total_products'] ?? '';
    $cart_total = $_SESSION['total_price'] ?? 0;
    $placed_on = $_SESSION['placed_on'] ?? '';
    $method = "e-sewa";

    // Insert order
    mysqli_query($conn, "INSERT INTO `orders` (user_id, name, number, email, method, address, total_products, total_price, placed_on)
VALUES('$user_id', '$name', '$number', '$email', '$method', '$address', '$total_products', '$cart_total', '$placed_on')") or die('order insert failed');

    // Clear cart
    mysqli_query($conn, "DELETE FROM `cart` WHERE user_id = '$user_id'");

    echo "<h2>Payment Successful via eSewa!</h2>
<p>Thank you for your purchase.</p>";

    // Optionally unset session values here
} else {
    echo "<h2>Payment Verification Failed!</h2>
<p>Invalid signature or payment was not completed.</p>";
}
