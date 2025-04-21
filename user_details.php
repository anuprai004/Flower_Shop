<?php

@include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if (!isset($user_id)) {
    header('location:login.php');
}
$user = mysqli_query($conn, "SELECT * FROM `users` WHERE id = '$user_id'") or die('query failed');
if (mysqli_num_rows($user) > 0) {
    while ($fetch_user = mysqli_fetch_assoc($user)) {
        $name = $fetch_user['name'];
        $email = $fetch_user['email'];
    }
}
$order_query = mysqli_query($conn, "SELECT COUNT(*) AS total_orders, SUM(total_price) AS total_spent FROM `orders` WHERE user_id = '$user_id'") or die('query failed');
$order_data = mysqli_fetch_assoc($order_query);
$total_orders = $order_data['total_orders'];
$total_spent = $order_data['total_spent'] ?? 0;


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>home</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">

</head>

<body>
    <?php @include 'header.php'; ?>
    <section class="home">
        <section class="user-dashboard" style="font-size: 3rem;">
            <h2>Welcome, <?php echo $name; ?> </h2>
            <p>Email: <strong><?php echo $email; ?></strong></p>
            <p>Total Orders: <strong><?php echo $total_orders; ?></strong></p>
            <p>Total Spendings: <strong>Rs. <?php echo number_format($total_spent, 2); ?></strong></p>
        </section>


    </section>

    <?php @include 'footer.php'; ?>
    <script src="js/script.js"></script>

</body>

</html>