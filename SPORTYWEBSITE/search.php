<?php
include 'components/connect.php';

session_start();

if (isset($_SESSION['user_id'])) {
   $user_id = $_SESSION['user_id'];
} else {
   $user_id = '';
}

include 'components/add_cart.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>search page</title>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
   <link rel="stylesheet" href="css/style.css">
   <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
   <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
   <style>
     
      input[type="radio"] {
         display: none;
      } 
      label {
         display: inline-block;
         position: relative;
         padding: 10px 20px;
         font-size: 16px;
         background-color: #e0e0e0;
         border-radius: 20px;
         cursor: pointer;
         transition: background-color 0.3s ease;
      }
      input[type="radio"]:checked+label {
         background-color: #3498db;
         color: #fff;
      }
      input[type="radio"]:checked+label:before {
         transform: translateX(100%);
      }
      label:active {
         background-color: #f39c12;
      }

      label.active {
         background-color: #f39c12;
         color: #fff;
      }
      input[type="radio"]:checked+label {
         background-color: #3498db;
         color: #fff;
      }
   </style>
</head>

<body>

   <?php include 'components/user_header.php'; ?>
   <section class="search-form">
      <form method="post" action="" id="searchForm">
         <input type="text" name="search_box" id="search_box" placeholder="search here..." class="box">
         <label><input type="radio" name="filter" value="name" checked> Name</label>
         <label><input type="radio" name="filter" value="price"> Price</label>
         <label><input type="radio" name="filter" value="details"> color</label>
      </form>
   </section>
   <section class="products" style="min-height: 100vh; padding-top:0;">

      <div class="box-container" id="productContainer">

      </div>

   </section>



   <?php include 'components/footer.php'; ?>

   <script src="js/script.js"></script>
   <script>
      $(document).ready(function () {
         $('#search_box').on('input', function () {
            var searchBox = $(this).val();
            var filterOption = $('input[name="filter"]:checked').val();

            $.ajax({
               type: 'POST',
               url: 'search_ajax.php',
               data: {
                  search_box: searchBox,
                  filter: filterOption 
               },
               success: function (response) {
                  $('#productContainer').html(response);
               }
            });
         });

         $('#search_box').on('keyup', function () {
            var searchBox = $(this).val();
            if (searchBox === "") {
               var filterOption = $('input[name="filter"]:checked').val();

               $.ajax({
                  type: 'POST',
                  url: 'search_ajax.php',
                  data: {
                     search_box: searchBox,
                     filter: filterOption 
                  },
                  success: function (response) {
                     $('#productContainer').html(response);
                  }
               });
            }
         });
      });
   </script>
   <script>
      $(document).ready(function () {
         $('input[name="filter"]').on('change', function () {
            $('label').removeClass('active');
            $(this).closest('label').addClass('active');
         });
      });
   </script>

</body>

</html>