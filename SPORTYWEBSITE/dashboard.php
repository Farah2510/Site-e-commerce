<?php

include 'components\connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if (!isset($admin_id)) {
   header('location:admin_login.php');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>dashboard</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">


   <link rel="stylesheet" href="css\admin_style.css">
   <style>
      .box {
         display: inline-block;

      }

      .box-container {
         display: flex;


      }

      .box1 {
         border: 1px solid #ccc;
         padding: 30px;
         text-align: center;
         background-color: #f8f8f8;
         box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
         border-radius: 20px;
         margin: 70px;
         font-size: 20px;

      }

      .box1 h3 {
         color: #333;
      }

      .box1 p {
         color: #666;
      }
   </style>

</head>

<body>

   <?php include 'components\admin_header.php' ?>



   <section class="dashboard">

      <h1 class="heading">dashboard</h1>

      <div class="box-container1">

         <div class="box1">
            <h3>welcome!</h3>
            <p>
               <?= $fetch_profile['name']; ?>
            </p>

         </div>
      </div>

      <div class="box-container">
         <div class="box">
            <?php
            $select_orders = $conn->prepare("SELECT * FROM `orders`");
            $select_orders->execute();
            $numbers_of_orders = $select_orders->rowCount();
            ?>
            <h3>
               <?= $numbers_of_orders; ?>
            </h3>

            <a href="placed_orders.php" class="btn">see orders</a>
         </div>


         <div class="box">
            <?php
            $select_products = $conn->prepare("SELECT * FROM `products`");
            $select_products->execute();
            $numbers_of_products = $select_products->rowCount();
            ?>
            <h3>
               <?= $numbers_of_products; ?>
            </h3>

            <a href="products.php" class="btn">see products</a>
         </div>

         <div class="box">
            <?php
            $select_users = $conn->prepare("SELECT * FROM `users`");
            $select_users->execute();
            $numbers_of_users = $select_users->rowCount();
            ?>
            <h3>
               <?= $numbers_of_users; ?>
            </h3>

            <a href="users_accounts.php" class="btn">see users</a>
         </div>


      </div>
   </section>
   <script src="js\admin_script.js"></script>
   <link rel="stylesheet" href="css\admin_style.css" />


</body>

</html>