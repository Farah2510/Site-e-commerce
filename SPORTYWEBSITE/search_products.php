<?php
include 'components/connect.php';

if (isset($_POST['search_box'])) {
    $search_box = $_POST['search_box'];
    $select_products = $conn->prepare("SELECT * FROM `products` WHERE name LIKE :search_box");
    $select_products->bindValue(':search_box', "%$search_box%", PDO::PARAM_STR);
    $select_products->execute();

    if ($select_products->rowCount() > 0) {
        while ($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)) {
            ?>

            <div class="box">
                <img src="project images/<?= $fetch_products['image']; ?>" alt="">
                <div class="flex">
                    <div class="price">
                        <?= $fetch_products['price']; ?><span>dt</span>
                    </div>
                </div>
                <div class="name">
                    <?= $fetch_products['name']; ?>
                </div>
                <div class="details">
                    <?= $fetch_products['details']; ?>
                </div>
                <div class="flex-btn">
                    <a href="update_product.php?update=<?= $fetch_products['id']; ?>" class="delete-btn"
                        color="secondary">update</a>
                    <a href="products.php?delete=<?= $fetch_products['id']; ?>" class="delete-btn"
                        onclick="return confirm('delete this product?');">delete</a>
                </div>
            </div>
            <?php
        }
    } else {
        echo '<p class="empty">No products found!</p>';
    }
}
?>