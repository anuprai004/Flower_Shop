<?php
session_start();

// if (!isset($_SESSION['total_price'])) {
//     echo "total_price is not set in session.";
//     echo "<pre>";
//     print_r($_SESSION);
//     echo "</pre>";
//     exit;
// }

$amount = (float) $_SESSION['total_price'];
$tax_amount = 0;
$product_service_charge = 0;
$product_delivery_charge = 0;
$total_amount = $amount + $tax_amount + $product_service_charge + $product_delivery_charge;

$transaction_uuid = strval(rand(10000, 99999));
$product_code = "EPAYTEST";
$secret_key = "8gBm/:&EnhH.1/q";

$signed_field_names = "total_amount,transaction_uuid,product_code";
$signature_raw = "total_amount=$total_amount,transaction_uuid=$transaction_uuid,product_code=$product_code";
$signature = base64_encode(hash_hmac('sha256', $signature_raw, $secret_key, true));
?>

<form action="https://rc-epay.esewa.com.np/api/epay/main/v2/form" method="POST" id="esewaPaymentForm">
    <input type="hidden" name="amount" value="<?= $amount ?>">
    <input type="hidden" name="tax_amount" value="<?= $tax_amount ?>">
    <input type="hidden" name="total_amount" value="<?= $total_amount ?>">
    <input type="hidden" name="transaction_uuid" value="<?= $transaction_uuid ?>">
    <input type="hidden" name="product_code" value="<?= $product_code ?>">
    <input type="hidden" name="product_service_charge" value="<?= $product_service_charge ?>">
    <input type="hidden" name="product_delivery_charge" value="<?= $product_delivery_charge ?>">
    <input type="hidden" name="success_url" value="http://localhost/flower_shop/esewa_success.php">
    <input type="hidden" name="failure_url" value="http://localhost/flower_shop/esewa_failure.php">
    <input type="hidden" name="signed_field_names" value="<?= $signed_field_names ?>">
    <input type="hidden" name="signature" value="<?= $signature ?>">
</form>

<script>
    document.getElementById("esewaPaymentForm").submit();
</script>