<?php
include 'components/connect.php';

session_start();

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
} else {
    $user_id = '';
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>search page</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link rel="stylesheet" href="css\style.css">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
</head>

<body>

    <?php include 'components\admin_header.php'; ?>
    <section class="search-form">
        <form method="post" action="" id="searchForm">
            <input type="text" name="search_box" id="search_box" placeholder="search here..." class="box">
        </form>
    </section>
    <section class="products" style="min-height: 100vh; padding-top:0;">

        <div class="box-container" id="productContainer">

        </div>

    </section>




    <script src="js\script.js"></script>
    <script>
        $(document).ready(function () {
            $('#search_box').on('input', function () {
                var searchBox = $(this).val();
                $.ajax({
                    type: 'POST',
                    url: 'search_products.php',
                    data: {
                        search_box: searchBox
                    },
                    success: function (response) {
                        $('#productContainer').html(response);
                    }
                });
            });


            $('#search_box').on('keyup', function () {
                var searchBox = $(this).val();
                if (searchBox === "") {
                    $.ajax({
                        type: 'POST',
                        url: 'search_products.php',
                        data: {
                            search_box: searchBox
                        },
                        success: function (response) {
                            $('#productContainer').html(response);
                        }
                    });
                }
            });
        });
    </script>
</body>

</html>