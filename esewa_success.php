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

if (!$response || !isset($response['signature'])) {
    echo "Invalid or incomplete response.";
    exit;
}

// Regenerate the signature string using the same order as `signed_field_names`
$raw_string = "transaction_code={$response['transaction_code']},status={$response['status']},total_amount={$response['total_amount']},transaction_uuid={$response['transaction_uuid']},product_code={$response['product_code']},signed_field_names={$response['signed_field_names']}";

// Recreate signature
$expected_signature = base64_encode(hash_hmac('sha256', $raw_string, $secret_key, true));
$paymentSuccessful;
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
    mysqli_query($conn, "INSERT INTO `orders` (user_id, name, number, email, method, address, total_products, total_price, placed_on, payment_status)
VALUES('$user_id', '$name', '$number', '$email', '$method', '$address', '$total_products', '$cart_total', '$placed_on', 'completed')") or die('order insert failed');

    mysqli_query($conn, "DELETE FROM `cart` WHERE user_id = '$user_id'");
    $paymentSuccessful = true;
} else {
    $paymentSuccessful = false;
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>success payment</title>

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <!-- custom admin css file link  -->
    <link rel="stylesheet" href="css/style.css">

</head>

<body>

    <?php @include 'header.php'; ?>

    <section class="esewa-success">
        <?php
        if ($paymentSuccessful) {
            echo "<center><h2 style='font-size:4rem' >Payment Successfull</h2><p style='font-size:3rem'>Thank you for odering beautiful flowers!</p></center> ";
        }
        ?>

    </section>
    <div class="more-btn">
        <a href="shop.php" class="option-btn">Shop more</a>
    </div>

    </section>
    <?php @include 'footer.php'; ?>

    <script src="js/script.js"></script>

</body>

</html>