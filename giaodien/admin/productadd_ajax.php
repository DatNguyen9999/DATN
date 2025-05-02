<?php
include "class/product_class.php";
$product = new product;

if (isset($_GET['cartegory_id'])) {
    $cartegory_id = $_GET['cartegory_id'];
    $show_brand_ajax = $product->show_brand_ajax($cartegory_id);
    if ($show_brand_ajax) {
        while ($result = $show_brand_ajax->fetch_assoc()) {
            echo '<option value="' . $result['brand_id'] . '">' . $result['brand_name'] . '</option>';
        }
    }
} else {
    echo '<option value="">Chưa chọn danh mục</option>';
}
?>
