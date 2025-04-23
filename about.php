<?php

@include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if (!isset($user_id)) {
    header('location:login.php');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>about</title>

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <!-- custom admin css file link  -->
    <link rel="stylesheet" href="css/style.css">

</head>

<body>

    <?php @include 'header.php'; ?>

    <section class="heading">
        <h3>about us</h3>
        <p> <a href="home.php">home</a> / about </p>
    </section>

    <section class="about">

        <div class="flex">

<<<<<<< HEAD
        <div class="content">
            <h3>why choose us?</h3>
            <p>We source our flowers daily to ensure you receive only the freshest blooms. Every arrangement is handcrafted with love and care by our expert florists.</p>
            <a href="shop.php" class="btn">shop now</a>
        </div>

    </div>

    <div class="flex">

        <div class="content">
            <h3>what we provide?</h3>
            <p>We offer a wide variety of fresh, seasonal blooms sourced daily to ensure top quality and longevity. Every bouquet is thoughtfully arranged with love and care.</p>
            <a href="contact.php" class="btn">contact us</a>
        </div>

        <div class="image">
            <img src="images/about-img-2.jpg" alt="">
        </div>

    </div>

    <div class="flex">

        <div class="image">
            <img src="images/about-img-3.jpg" alt="">
        </div>

        <div class="content">
            <h3>who we are?</h3>
            <p>Welcome to Ikigai Flower Shop – where every bloom tells a story.
We’re a passionate team of flower lovers dedicated to spreading joy through beautiful, fresh, and handcrafted floral arrangements. Whether it’s a special celebration or just because, we’re here to help you express your feelings with the perfect bouquet.

Rooted in love and creativity, we believe flowers have the power to brighten lives – and we’re proud to bring that happiness right to your doorstep.</p>
            <a href="#reviews" class="btn">clients reviews</a>
        </div>

    </div>

</section>

<section class="reviews" id="reviews">

    <h1 class="title">client's reviews</h1>

    <div class="box-container">

        <div class="box">
            <img src="images/pic-1.png" alt="">
            <p>Beautiful flowers and super fast delivery! My mom loved her birthday bouquet. Thank you!</p>
            <div class="stars">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star-half-alt"></i>
=======
            <div class="image">
                <img src="images/about-img-1.png" alt="">
>>>>>>> d531081510e53614ca7c5047bbe680ae88132889
            </div>

<<<<<<< HEAD
        <div class="box">
            <img src="images/pic-2.png" alt="">
            <p>Great service and fresh flowers every time. Ordering online was easy and quick!</p>
            <div class="stars">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star-half-alt"></i>
=======
            <div class="content">
                <h3>why choose us?</h3>
                <p>Choose us for fresh, beautifully arranged flowers delivered with care, ensuring every occasion blooms with love and joy!</p>
                <a href="shop.php" class="btn">shop now</a>
>>>>>>> d531081510e53614ca7c5047bbe680ae88132889
            </div>

        </div>

<<<<<<< HEAD
        <div class="box">
            <img src="images/pic-3.png" alt="">
            <p>Lovely arrangement, just like the photo. Slight delay in delivery but worth the wait!</p>
            <div class="stars">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star-half-alt"></i>
=======
        <div class="flex">

            <div class="content">
                <h3>what we provide?</h3>
                <p>We provide a wide range of fresh, handpicked flowers for every occasion, beautifully arranged and delivered right to your doorstep. From bouquets for birthdays to wedding arrangements, we ensure your special moments bloom with love and elegance.</p>
                <a href="contact.php" class="btn">contact us</a>
>>>>>>> d531081510e53614ca7c5047bbe680ae88132889
            </div>

<<<<<<< HEAD
        <div class="box">
            <img src="images/pic-4.png" alt="">
            <p>Excellent quality and amazing customer support. Will definitely order again!</p>
            <div class="stars">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star-half-alt"></i>
=======
            <div class="image">
                <img src="images/about-img-2.jpg" alt="">
>>>>>>> d531081510e53614ca7c5047bbe680ae88132889
            </div>

        </div>

<<<<<<< HEAD
        <div class="box">
            <img src="images/pic-5.png" alt="">
            <p>The flowers were fresh and smelled amazing. Perfect gift for my anniversary!</p>
            <div class="stars">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star-half-alt"></i>
=======
        <div class="flex">

            <div class="image">
                <img src="images/about-img-3.jpg" alt="">
>>>>>>> d531081510e53614ca7c5047bbe680ae88132889
            </div>

<<<<<<< HEAD
        <div class="box">
            <img src="images/pic-6.png" alt="">
            <p>Great prices and lots of options. Some flowers wilted quickly, but overall very happy</p>
            <div class="stars">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star-half-alt"></i>
=======
            <div class="content">
                <h3>who we are?</h3>
                <p>We are a passionate team of floral experts dedicated to bringing beauty and joy to your special moments. With a love for flowers and an eye for design, we carefully curate and deliver stunning floral arrangements to brighten any occasion, all while providing exceptional service and convenience.</p>
                <a href="#reviews" class="btn">clients reviews</a>
>>>>>>> d531081510e53614ca7c5047bbe680ae88132889
            </div>

        </div>

    </section>

    <?php @include 'footer.php'; ?>

    <script src="js/script.js"></script>

</body>

</html>