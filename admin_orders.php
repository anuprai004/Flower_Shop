<?php

@include 'config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if (!isset($admin_id)) {
   header('location:login.php');
};

if (isset($_POST['update_order'])) {
   $order_id = $_POST['order_id'];
   $update_payment = $_POST['update_payment'];
   mysqli_query($conn, "UPDATE `orders` SET payment_status = '$update_payment' WHERE id = '$order_id'") or die('query failed');
   $message[] = 'payment status has been updated!';
}
if (isset($_POST['update_order_status'])) {
   $order_id = $_POST['order_id'];
   $new_status = $_POST['update_status'];
   if ($new_status == 'delivered') {
      mysqli_query($conn, "UPDATE `orders` SET payment_status = 'completed' WHERE id = '$order_id'") or die('Update failed');
   }
   mysqli_query($conn, "UPDATE `orders` SET order_status = '$new_status' WHERE id = '$order_id'") or die('Update failed');
   $message[] = 'order status has been updated!';
}


if (isset($_GET['delete'])) {
   $delete_id = $_GET['delete'];
   mysqli_query($conn, "DELETE FROM `orders` WHERE id = '$delete_id'") or die('query failed');
   header('location:admin_orders.php');
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

   <section class="placed-orders">

      <h1 class="title">Placed Orders</h1>

      <table>
         <thead>
            <tr>
               <th>Name</th>
               <th>Placed On</th>
               <th>Number</th>
               <th>Address</th>
               <th>Total Products</th>
               <th>Total Price</th>
               <th>Payment Method</th>
               <th>Payment Status</th>
               <th>Order Status</th>
               <th>Action</th>
            </tr>
         </thead>
         <tbody>
            <?php
            $select_orders = mysqli_query($conn, "SELECT * FROM `orders`") or die('query failed');
            if (mysqli_num_rows($select_orders) > 0) {
               while ($fetch_orders = mysqli_fetch_assoc($select_orders)) {
            ?>
                  <tr>
                     <td><?php echo $fetch_orders['name']; ?></td>
                     <td><?php echo $fetch_orders['placed_on']; ?></td>
                     <td><?php echo $fetch_orders['number']; ?></td>
                     <td><?php echo $fetch_orders['address']; ?></td>
                     <td><?php echo $fetch_orders['total_products']; ?></td>
                     <td>$<?php echo $fetch_orders['total_price']; ?>/-</td>
                     <td><?php echo $fetch_orders['method']; ?></td>
                     <td><span style="color:<?php if ($fetch_orders['payment_status'] == 'pending') {
                                                echo 'goldenrod';
                                             } elseif ($fetch_orders['payment_status'] == 'completed') {
                                                echo 'green';
                                             } ?>"><?php echo ucfirst($fetch_orders['payment_status']); ?></span><br><br>
                        <form action="" method="post">
                           <input type="hidden" name="order_id" value="<?php echo $fetch_orders['id']; ?>">
                           <select name="update_payment">
                              <option selected><?php echo $fetch_orders['payment_status']; ?></option>
                              <?php
                              if ($fetch_orders['payment_status'] == "pending") { ?>
                                 <option value="completed">Completed</option>
                              <?php
                              } else {
                              ?>
                                 <option value="pending">Pending</option>
                              <?php
                              }
                              ?>
                           </select>
                           <input type="submit" name="update_order" value="Update" class="option-btn" onclick="return confirm('Update this order payment status?');">
                        </form>
                     </td>
                     <td> <span style="color:<?php if ($fetch_orders['order_status'] == 'delivered') {
                                                echo 'green';
                                             } elseif ($fetch_orders['order_status'] == 'processing') {
                                                echo 'goldenrod';
                                             } elseif ($fetch_orders['order_status'] == 'accepted') {
                                                echo 'blue';
                                             } elseif ($fetch_orders['order_status'] == 'on the way') {
                                                echo 'rgb(5, 232, 156)';
                                             } elseif ($fetch_orders['order_status'] == 'refunded') {
                                                echo 'rgb(98, 0, 255)';
                                             } elseif ($fetch_orders['order_status'] == 'canceled') {
                                                echo 'red';
                                             } ?>"><?php echo ucfirst($fetch_orders['order_status']); ?></span><br><br>
                        <form action="" method="post">
                           <input type="hidden" name="order_id" value="<?php echo $fetch_orders['id']; ?>">

                           <select name="update_status">

                              <option selected><?php echo ucfirst($fetch_orders['order_status']); ?></option>

                              <?php
                              $statuses = ['processing', 'accepted', 'on the way', 'delivered', 'refunded', 'canceled'];
                              foreach ($statuses as $status) {
                                 if ($status !== $fetch_orders['order_status']) {
                                    echo "<option value='$status'>" . ucfirst($status) . "</option>";
                                 }
                              }
                              ?>
                           </select>

                           <input type="submit" name="update_order_status" value="Update" class="option-btn" onclick="return confirm('Update this order status?');">
                        </form>

                     </td>
                     <td>
                        <a href="admin_orders.php?delete=<?php echo $fetch_orders['id']; ?>" class="delete-btn" onclick="return confirm('Delete this order?');">Delete</a>
                     </td>
                  </tr>
            <?php
               }
            } else {
               echo '<tr><td colspan="11" class="empty">No orders placed yet!</td></tr>';
            }
            ?>
         </tbody>
      </table>

   </section>

   <script src="js/admin_script.js"></script>

</body>

</html>