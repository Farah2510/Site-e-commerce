<?php

include 'components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if (!isset($admin_id)) {
    header('location:admin_login.php');
    exit();
}

$message = array();

if (isset($_POST['update'])) {
    $category_id = $_POST['category_id'];
    $category_id = filter_var($category_id, FILTER_SANITIZE_STRING);

    $name = $_POST['name'];
    $name = filter_var($name, FILTER_SANITIZE_STRING);

    $image = $_FILES['image']['name'];
    $image = filter_var($image, FILTER_SANITIZE_STRING);
    $image_size = $_FILES['image']['size'];
    $image_tmp_name = $_FILES['image']['tmp_name'];
    $image_folder = '../uploaded_img/' . $image;

    // Vérifie si la catégorie avec le même nom existe déjà
    $select_categories = $conn->prepare("SELECT * FROM `category` WHERE nom = ? AND code <> ?");
    $select_categories->execute([$name, $category_id]);

    if ($select_categories->rowCount() > 0) {
        $message[] = 'Category name already exists!';
    } else {
       
        $update_category = $conn->prepare("UPDATE `category` SET nom = ? WHERE code = ?");
        $update_category->execute([$name, $category_id]);

        $message[] = 'Category updated!';
        if (!empty($image)) {
            if ($image_size > 2000000) {
                $message[] = 'Image size is too large!';
            } else {
                move_uploaded_file($image_tmp_name, $image_folder);

                $update_image = $conn->prepare("UPDATE `category` SET image = ? WHERE code = ?");
                $update_image->execute([$image, $category_id]);

                $message[] = 'Image updated!';
            }
        }
    }
    header('location: add_category.php');
    exit;
}

// Récupère les catégories existantes
$sqlCategories = "SELECT code, nom FROM category";
$stmtCategories = $conn->prepare($sqlCategories);
$stmtCategories->execute();
$categories = $stmtCategories->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Category</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">


    <link rel="stylesheet" href="css/admin_style.css">

</head>

<body>

    <?php include 'components/admin_header.php'; ?>

    <section class="update-category">
        <h1 class="heading">Update Category</h1>

        <?php
        $update_id = $_GET['update'];
        $show_category = $conn->prepare("SELECT * FROM `category` WHERE code = ?");
        $show_category->execute([$update_id]);

        if ($show_category->rowCount() > 0) {
            $fetch_category = $show_category->fetch(PDO::FETCH_ASSOC);
            ?>
            <form action="" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="category_id" value="<?= $fetch_category['code']; ?>">
                <img src="images/<?= $fetch_category['image']; ?>" alt=""></br>
                <span>Update Name</span> </br>
                <input type="text" required placeholder="Enter category name" name="name" maxlength="100" class="box"
                    value="<?= $fetch_category['nom']; ?>"></br>
                <span>Update Image</span></br>
                <input type="file" name="image" class="box" accept="image/jpg, image/jpeg, image/png, image/webp">
                <div class="flex-btn">
                    <input type="submit" value="Update" class="btn" name="update">
                    <a href="add_category.php" class="option-btn">Go Back</a>
                </div>
            </form>
            <?php
        } else {
            echo '<p class="empty">Category not found!</p>';
        }
        ?>
    </section>

    <script src="js/admin_script.js"></script>

</body>

</html>