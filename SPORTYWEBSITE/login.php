<?php
include 'components/connect.php';

session_start();

if (isset($_SESSION['user_id'])) {
   $user_id = $_SESSION['user_id'];
} else {
   $user_id = '';
}


if (isset($_COOKIE['remember_email']) && isset($_COOKIE['remember_password'])) {
   $cookie_email = $_COOKIE['remember_email'];
   $cookie_password = $_COOKIE['remember_password'];
} else {
   $cookie_email = '';
   $cookie_password = '';
}

if (isset($_POST['submit'])) {
   $email = $_POST['email'];
   $email = filter_var($email, FILTER_SANITIZE_STRING);
   $pass = sha1($_POST['pass']);
   $pass = filter_var($pass, FILTER_SANITIZE_STRING);

   $select_user = $conn->prepare("SELECT * FROM `users` WHERE email = ? AND password = ?");
   $select_user->execute([$email, $pass]);
   $row = $select_user->fetch(PDO::FETCH_ASSOC);

   if ($select_user->rowCount() > 0) {
      $_SESSION['user_id'] = $row['id'];

      // Code pour "Remember Me"
      if (isset($_POST['remember'])) {
         //  créeation des cookies pour l'email et le mot de passe
         $cookie_name_email = 'remember_email';
         $cookie_name_password = 'remember_password';
         $cookie_value_email = $email;
         $cookie_value_password = $pass; //  stocker le mot de passe en texte brut dans un cookie n'est pas recommandé pour des raisons de sécurité.
         setcookie($cookie_name_email, $cookie_value_email, time() + 3600 * 24 * 7, '/'); // Cookie valable pendant une semaine
         setcookie($cookie_name_password, $cookie_value_password, time() + 3600 * 24 * 7, '/'); // Cookie valable pendant une semaine
      }

      header('location:home.php');
   } else {
      $message[] = 'Incorrect email or password!';
   }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>login</title>


   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">


   <link rel="stylesheet" href="css/style.css">
   <style>
      .checkbox-inline input {
         margin-right: 5px;
         vertical-align: middle;
      }

      .checkbox-inline label {

         font-weight: normal;
         vertical-align: middle;
      }
   </style>
</head>

<body>


   <?php include 'components/user_header.php'; ?>


   <section class="form-container">

      <form action="" method="post">
         <h3>login now</h3>
         <input type="email" name="email" required placeholder="enter your email" class="box" maxlength="50"
            oninput="this.value = this.value.replace(/\s/g, '')">
         <input type="password" name="pass" required placeholder="enter your password" class="box" maxlength="50"
            oninput="this.value = this.value.replace(/\s/g, '')">
         <!-- Case à cocher "Se souvenir de moi" -->
         <div class="clearfix">
            <label class="pull-left checkbox-inline">
               <input type="checkbox" name="remember" value="1">Remember me
            </label>
         </div>
         <br />
         <!--<?php
         if (!empty($message)) {
            foreach ($message as $msg) {
               echo "<p class='message'>$msg</p>";
            }
         }
         ?>-->
         <input type="submit" value="login now" name="submit" class="btn">
         <p>don't have an account? <a href="register.php">register now</a></p>
      </form>

   </section>
   <?php include 'components/footer.php'; ?>
   <script src="js/script.js"></script>

</body>


</html>