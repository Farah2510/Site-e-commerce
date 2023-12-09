<?php

include 'components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if (!isset($admin_id)) {
    header('location:admin_login.php');
    exit(); // Ajout de cette ligne pour éviter l'exécution du reste du code si la redirection est effectuée
}

$message = array();
// Initialisez le tableau $message pour éviter une erreur si la variable n'est pas définie.

if (isset($_POST['add_category'])) {

    $name = $_POST['name'];
    $name = filter_var($name, FILTER_SANITIZE_STRING);
    $image = $_FILES['image']['name'];
    $image = filter_var($image, FILTER_SANITIZE_STRING);
    $image_size = $_FILES['image']['size'];
    $image_tmp_name = $_FILES['image']['tmp_name'];
    $image_folder = '../uploaded_img/' . $image;

    $select_categories = $conn->prepare("SELECT * FROM `category` WHERE nom = ?");
    $select_categories->execute([$name]);

    if ($select_categories->rowCount() > 0) {
        $message[] = 'Category name already exists!';
    } else {
        if ($image_size > 2000000) {
            $message[] = 'Image size is too large';
        } else {
            //move_uploaded_file($image_tmp_name, $image_folder);

            $insert_category = $conn->prepare("INSERT INTO `category`(nom, image) VALUES(:nom, :image)");
            $insert_category->bindParam(':nom', $name, PDO::PARAM_STR);
            $insert_category->bindParam(':image', $image, PDO::PARAM_STR);
            $insert_category->execute();
            $message[] = 'New category added!';
        }
    }

}

if (isset($_GET['delete'])) {
    $delete_id = $_GET['delete'];
    $delete_category_image = $conn->prepare("SELECT * FROM `category` WHERE code = ?");
    $delete_category_image->execute([$delete_id]);
    $fetch_delete_image = $delete_category_image->fetch(PDO::FETCH_ASSOC);

    if ($fetch_delete_image) {
        unlink('../uploaded_img/' . $fetch_delete_image['image']);
        $delete_category = $conn->prepare("DELETE FROM `category` WHERE code = ?");
        $delete_category->execute([$delete_id]);
        header('location:add_category.php');
        exit(); // Ajout de cette ligne pour éviter l'exécution du reste du code après la redirection.
    } else {
        $message[] = 'Category not found!';
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Category</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link rel="stylesheet" href="css\admin_style.css">

</head>

<body>

    <?php include 'components/admin_header.php'; ?>

    <section class="add-products">
        <form action="" method="POST" enctype="multipart/form-data">
            <h3>Add Category</h3>

            <input type="text" required placeholder="Enter category name" name="name" maxlength="100" class="box">
            <input type="file" name="image" class="box" accept="image/jpg, image/jpeg, image/png, image/webp" required>
            <input type="submit" value="Add Category" name="add_category" class="btn">
        </form>
    </section>

    <section class="show-products" style="padding-top: 0;">
        <div class="box-container">
            <?php
            $show_category = $conn->prepare("SELECT * FROM `category`");
            $show_category->execute();
            if ($show_category->rowCount() > 0) {
                while ($fetch_category = $show_category->fetch(PDO::FETCH_ASSOC)) {
                    ?>

                    <div class="box">
                        <img src="images/<?= $fetch_category['image']; ?>" alt="">
                        <div class="name">
                            <?= $fetch_category['nom']; ?>
                        </div>

                        <div class="flex-btn">

                            <a href="update_category.php?update=<?= $fetch_category['code']; ?>" class="option-btn">Update</a>
                            <a href="add_category.php?delete=<?= $fetch_category['code']; ?>" class="delete-btn"
                                onclick="return confirm('Delete this category?');">Delete</a>
                        </div>
                    </div>
                    <?php
                }
            } else {
                echo '<p class="empty">No category added yet!</p>';
            }
            ?>
        </div>
    </section>
    <script src="js\admin_script.js"></script>
</body>

</html>