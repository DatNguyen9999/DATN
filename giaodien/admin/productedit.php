<?php
include "header.php";
include "slider.php";
include "class/product_class.php";

$product = new product;

if (!isset($_GET['product_id']) || $_GET['product_id'] == NULL) {
    echo "<script>window.location = 'productlist.php'</script>";
} else {
    $product_id = $_GET['product_id'];
}

$get_product = $product->get_product($product_id);

if ($get_product) {
    $product_data = $get_product->fetch_assoc();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $update_product = $product->update_product($product_id, $_POST, $_FILES);
}
?>
<div class="admin-content-right">
    <div class="admin-content-right-product-add">
        <h1>Sửa sản phẩm</h1>
        <form action="" method="POST" enctype="multipart/form-data">
            <label>Tên sản phẩm</label>
            <input name="product_name" required type="text" value="<?php echo $product_data['product_name']; ?>">

            <label>Danh mục</label>
            <select name="cartegory_id">
                <?php
                $show_cartegory = $product->show_cartegory();
                if ($show_cartegory) {
                    while ($row = $show_cartegory->fetch_assoc()) {
                        $selected = $row['cartegory_id'] == $product_data['cartegory_id'] ? "selected" : "";
                        echo "<option value='" . $row['cartegory_id'] . "' $selected>" . $row['cartegory_name'] . "</option>";
                    }
                }
                ?>
            </select>
            <label>Loại sản phẩm</label>
            <select name="brand_id">
                <?php
                $show_brand = $product->show_brand();
                if ($show_brand) {
                    while ($row = $show_brand->fetch_assoc()) {
                        $selected = $row['brand_id'] == $product_data['brand_id'] ? "selected" : "";
                        echo "<option value='" . $row['brand_id'] . "' $selected>" . $row['brand_name'] . "</option>";
                    }
                }
                ?>
            </select>

            <label>Giá sản phẩm</label>
            <input name="product_price" required type="text" value="<?php echo $product_data['product_price']; ?>">

            <label>Giá khuyến mãi</label>
            <input name="product_price_new" required type="text" value="<?php echo $product_data['product_price_new']; ?>">

            <label>Mô tả sản phẩm</label>
            <textarea name="product_desc" id="editor1"><?php echo $product_data['product_desc']; ?></textarea>

            <label>Ảnh sản phẩm (chọn nếu muốn thay)</label>
            <input name="product_img" type="file">
            <img src="uploads/<?php echo $product_data['product_img']; ?>" width="100px">

            <button type="submit">Cập nhật</button>
        </form>
    </div>
</div>