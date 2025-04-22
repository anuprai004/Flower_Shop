<?php

@include 'config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if (!isset($admin_id)) {
   header('location:login.php');
};

if (isset($_GET['delete'])) {
   $delete_id = $_GET['delete'];
   mysqli_query($conn, "DELETE FROM `message` WHERE id = '$delete_id'") or die('query failed');
   header('location:admin_messages.php');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>dashboard</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom admin css file link  -->
   <link rel="stylesheet" href="css/admin_style.css">
   <style>
      /* Overall table layout */
      table {
         width: 100%;
         border-collapse: separate;
         border-spacing: 0;
         margin: 20px 0;
         box-shadow: 0 2px 12px rgba(0, 0, 0, 0.1);
         border-radius: 8px;
         overflow: hidden;
         background-color: #ffffff;
         font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      }

      /* Header style */
      th {
         background-color: #f8f9fa;
         color: #333;
         text-align: left;
         padding: 14px 20px;
         font-weight: 600;
         font-size: 2rem;
         border-bottom: 1px solid #dee2e6;
         border-right: 1px solid #e0e0e0;
      }

      /* Cell style */
      td {
         padding: 14px 20px;
         color: #444;
         border-bottom: 1px solid #f1f1f1;
         vertical-align: middle;
         font-size: 16px;
         border-right: 1px solid #e0e0e0;
      }

      /* Hover effect */
      tr:hover {
         background-color: #f5faff;
      }

      /* Zebra striping (optional) */
      tbody tr:nth-child(even) {
         background-color: #fafafa;
      }

      /* Select dropdown */
      select {
         padding: 8px 12px;
         border: 1px solid #ccc;
         border-radius: 5px;
         background-color: #fff;
         font-size: 15px;
         transition: all 0.2s ease-in-out;
      }

      select:focus {
         border-color: #007bff;
         outline: none;
         box-shadow: 0 0 0 2px rgba(0, 123, 255, 0.25);
      }

      /* Optional button style if used inside table */

      .delete-btn {
         background-color: rgb(255, 0, 0);
         color: white;
         padding: 8px 16px;
         border: none;
         border-radius: 4px;
         cursor: pointer;
         text-decoration: none;
         font-size: 14px;
         transition: background-color 0.2s ease-in-out;
      }

      .option-btn {
         background-color: rgb(0, 123, 255);
         color: white;
         padding: 8px 16px;
         border: none;
         border-radius: 4px;
         cursor: pointer;
         text-decoration: none;
         font-size: 14px;
         transition: background-color 0.2s ease-in-out;
      }

      .delete-btn:hover {
         background-color: rgb(176, 6, 6);
      }

      .option-btn:hover {
         background-color: #0056b3;
      }
   </style>

</head>

<body>

   <?php @include 'admin_header.php'; ?>

   <section class="messages">

      <h1 class="title">messages</h1>

      <?php
      $select_message = mysqli_query($conn, "SELECT * FROM `message`") or die('query failed');

      if (mysqli_num_rows($select_message) > 0) {
      ?>
         <table class="message-table">
            <thead>
               <tr>
                  <th>Name</th>
                  <th>Number</th>
                  <th>Email</th>
                  <th>Message</th>
                  <th>Action</th>
               </tr>
            </thead>
            <tbody>
               <?php while ($fetch_message = mysqli_fetch_assoc($select_message)) { ?>
                  <tr>
                     <td><?php echo $fetch_message['name']; ?></td>
                     <td><?php echo $fetch_message['number']; ?></td>
                     <td><?php echo $fetch_message['email']; ?></td>
                     <td><?php echo $fetch_message['message']; ?></td>
                     <td>
                        <a href="admin_messages.php?delete=<?php echo $fetch_message['id']; ?>" onclick="return confirm('Delete this message?');" class="delete-btn">Delete</a>
                     </td>
                  </tr>
               <?php } ?>
            </tbody>
         </table>
      <?php
      } else {
         echo '<p class="empty">You have no messages!</p>';
      }
      ?>


   </section>













   <script src="js/admin_script.js"></script>

</body>

</html>