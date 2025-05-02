<?php
    include "header.php";
    include "slider.php";
    include "class/product_class.php";

    $product = new product;
    $show_product = $product->show_product();
    
?>

<div class="admin-content-right">
    <div class="admin-content-right-cartegory-list">
        <h1>Danh sách sản phẩm</h1>
        <table>
            <tr>
                <th>STT</th>
                <th>Tên sản phẩm</th>
                <th>Danh mục</th>
                <th>Loại sản phẩm</th>
                <th>Giá gốc</th>
                <th>Giá khuyến mãi</th>
                <th>Ảnh</th>
                <th>Tùy biến</th>
            </tr>
            <?php 
                if ($show_product) {
                    $i = 0;
                    while ($result = $show_product->fetch_assoc()) {
                        $i++;
            ?>
            <tr>
                <td><?php echo $i; ?></td>
                <td><?php echo $result['product_name']; ?></td>
                <td><?php echo $result['cartegory_name']; ?></td>
                <td><?php echo $result['brand_name']; ?></td>
                <td><?php echo number_format((float)str_replace('.', '', $result['product_price'])); ?>đ</td>
                <td><?php echo number_format((float)str_replace('.', '', $result['product_price_new'])); ?>đ</td>
                <td>
                    <img src="uploads/<?php echo $result['product_img']; ?>" width="100px">
                </td>
                <td>
                    <a href="productedit.php?product_id=<?php echo $result['product_id']; ?>">Sửa</a> | 
                    <a onclick="return confirm('Bạn có chắc muốn xóa?')" href="productdelete.php?product_id=<?php echo $result['product_id']; ?>">Xóa</a>
                </td>
            </tr>
            <?php 
                    }
                }
            ?>
        </table>
    </div>
</div>
</section>
</body>
</html>
