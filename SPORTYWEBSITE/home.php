<?php
include 'components/connect.php';

session_start();

if (isset($_SESSION['user_id'])) {
   $user_id = $_SESSION['user_id'];
} else {
   $user_id = '';
}
;

if (isset($_SESSION['order_message'])) {
   $order_message = $_SESSION['order_message'];
   // Affichez le message où vous en avez besoin sur la page
   echo '<div class="message">' . $order_message[0] . '</div>';

   // Une fois affiché, supprimez la variable de session pour qu'elle ne soit pas affichée à chaque rafraîchissement
   unset($_SESSION['order_message']);
}

include 'components/add_cart.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>home</title>

   <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css" />
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
   <link rel="stylesheet" href="css/style.css">

</head>

<body>

   <?php include 'components/user_header.php'; ?>

   <section class="hero">

      <div class="swiper hero-slider">

         <div class="swiper-wrapper">



            <div class="swiper-slide slide">
               <div class="content">
                  <span>order online</span>
                  <h3>Give Your Workout <br /> A New style!</h3>
                  <a href="menu.php" class="btn">see collection</a>
               </div>
               <div class="image">
                  <img src="images/image1.png" alt="">
               </div>
            </div>

         </div>

         <div class="swiper-pagination"></div>

      </div>

   </section>

   <section class="category">
      <h1 class="title"> categories</h1>
      <div class="box-container">

         <?php
         // Fetch categories from the database
         $select_categories = $conn->prepare("SELECT * FROM category");
         $select_categories->execute();

         if ($select_categories->rowCount() > 0) {
            while ($fetch_category = $select_categories->fetch(PDO::FETCH_ASSOC)) {
               ?>
               <a href="category.php?category=<?= $fetch_category['code']; ?>" class="box">
                  <img src="images/<?= $fetch_category['image']; ?>" alt="">
                  <h3>
                     <?= $fetch_category['nom']; ?>
                  </h3>
               </a>
               <?php
            }
         } else {
            echo '<p class="empty">No categories available!</p>';
         }
         ?>

      </div>
   </section>

   <section class="products">

      <h1 class="title">Our collection</h1>

      <div class="box-container">

         <?php
         $select_products = $conn->prepare("SELECT * FROM `products` LIMIT 6");
         $select_products->execute();
         if ($select_products->rowCount() > 0) {
            while ($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)) {
               ?>
               <form action="category.php" method="get" class="box">
                  <input type="hidden" name="category" value="<?= urlencode($fetch_products['category']); ?>">
                  <input type="hidden" name="pid" value="<?= $fetch_products['id']; ?>">
                  <input type="hidden" name="name" value="<?= $fetch_products['name']; ?>">
                  <input type="hidden" name="price" value="<?= $fetch_products['price']; ?>">
                  <input type="hidden" name="image" value="<?= $fetch_products['image']; ?>">
                  <a href="quick_view.php?pid=<?= $fetch_products['id']; ?>" class="fas fa-eye"></a>
                  <img src="project images/<?= $fetch_products['image']; ?>" alt="">
                  <div class="name">
                     <?= $fetch_products['name']; ?>
                  </div>
                  <div class="flex">
                     <div class="price">
                        <?= $fetch_products['price']; ?><span>dt</span>
                     </div>

                  </div>
               </form>
               <?php
            }
         } else {
            echo '<p class="empty">no products added yet!</p>';
         }
         ?>

      </div>

      <div class="more-btn">
         <a href="menu.php" class="btn">view all</a>
      </div>

   </section>

   <?php include 'components/footer.php'; ?>

   <script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>
   <script src="js/script.js"></script>

   <script>

      var swiper = new Swiper(".hero-slider", {
         loop: true,
         grabCursor: true,
         effect: "flip",
         pagination: {
            el: ".swiper-pagination",
            clickable: true,
         },
      });

   </script>

</body>

</html>