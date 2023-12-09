<?php
include 'components/connect.php';

if (isset($_POST['search_box'])) {
    $search_box = $_POST['search_box'];
    $filter = isset($_POST['filter']) ? $_POST['filter'] : 'name';

    switch ($filter) {
        case 'name':
            $query = "SELECT * FROM `products` WHERE name LIKE ?";
            break;
        case 'price':
            $query = "SELECT * FROM `products` WHERE price LIKE ?";
            break;
        case 'details':
            $query = "SELECT * FROM `products` WHERE details LIKE ?";
            break;
        default:
            $query = "SELECT * FROM `products` WHERE name LIKE ?";
            break;
    }

    $select_products = $conn->prepare($query);

    $select_products->execute(["%$search_box%"]);
    if ($select_products->rowCount() > 0) {
        while ($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)) {
            ?>
            <form action="" method="post" class="box">
                <input type="hidden" name="pid" value="<?= $fetch_products['id']; ?>">
                <input type="hidden" name="name" value="<?= $fetch_products['name']; ?>">
                <input type="hidden" name="price" value="<?= $fetch_products['price']; ?>">
                <input type="hidden" name="image" value="<?= $fetch_products['image']; ?>">

                <button type="submit" class="fas fa-shopping-cart" name="add_to_cart"></button>
                <img src="project images/<?= $fetch_products['image']; ?>" alt="">
                <div class="name">
                    <?= $fetch_products['name']; ?>
                </div>
                <div class="flex">
                    <div class="price">
                        <?= $fetch_products['price']; ?><span>dt</span>
                    </div>
                    <input type="number" name="qty" class="qty" min="1" max="99" value="1" maxlength="2">
                </div>
            </form>
            <?php
        }
    }
}
?>