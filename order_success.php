<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>home</title>

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <!-- custom admin css file link  -->
    <link rel="stylesheet" href="css/style.css">

</head>

<body>

    <?php @include 'header.php'; ?>

    <section class="order-success">
        <?php
        echo "<center><h2 style='font-size:4rem' >Order successfully placed !</h2><p style='font-size:3rem'>Thank you for odering beautiful flowers !</p></center> ";
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