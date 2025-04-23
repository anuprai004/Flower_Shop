<?php
@include 'config.php';
session_start();

$admin_id = $_SESSION['admin_id'];

if (!isset($admin_id)) {
    header('location:login.php');
};
if (isset($_POST['submit'])) {
    $filter_email = filter_var($_POST['email'], FILTER_SANITIZE_STRING);
    $email = mysqli_real_escape_string($conn, $filter_email);

    $select_users = mysqli_query($conn, "SELECT * FROM `users` WHERE email = '$email'") or die('query failed');


    if (mysqli_num_rows($select_users) > 0) {

        $row = mysqli_fetch_assoc($select_users);
        $id = $row['id'];

        if ($row['user_type'] == 'admin') {
            $message[] = 'user is already an admin !';
        } elseif ($row['user_type'] == 'user') {
            $update_user = mysqli_query($conn, "UPDATE `users` SET user_type = 'admin' WHERE id = $id");
            header('location:add_admin.php');
        } else {
            $message[] = 'no user found !';
        }
    } else {
        $message[] = 'incorrect email !';
    }
    $message[] = "admin added successfully";
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New admin</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- custom admin css file link  -->
    <link rel="stylesheet" href="css/admin_style.css">
    <link rel="stylesheet" href="css/style.css">
</head>

<body><?php @include 'admin_header.php';
        if (isset($message)) {
            foreach ($message as $message) {
                echo '
      <div class="message">
         <span>' . $message . '</span>
         <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
      </div>
      ';
            }
        }
        ?><section class="form-container">
        <form action="" method="post">
            <h3>Add New Admin</h3><input type="email" name="email" class="box" placeholder="enter email" required><input type="submit" class="btn" name="submit" value="add now">
        </form>
    </section>
</body>

</html>