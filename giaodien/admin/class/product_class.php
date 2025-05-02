<?php
    include "database.php";
?>
<?php
    class product{
        private $db;

        public function __construct()
        {
            $this -> db = new Database();
        }
         // ---------------------Show danh mục ---------------------
         public function show_cartegory(){
            $query = "SELECT * FROM tbl_cartegory ORDER BY cartegory_id DESC ";
            $result = $this ->db->select($query);
            return $result;
        }
         // ---------------------Show danh loại sản phẩm---------------------
         public function show_brand(){
            // $query = "SELECT * FROM tbl_brand ORDER BY brand_id DESC ";
            $query = "SELECT tbl_brand.* , tbl_cartegory.cartegory_name FROM tbl_brand
            INNER JOIN tbl_cartegory ON tbl_brand.cartegory_id = tbl_cartegory.cartegory_id
            ORDER BY tbl_brand.brand_id DESC";
            $result = $this ->db->select($query);
            return $result;
        }
        // ---------------------Lấy thông tin loại sản phẩm---------------------
        public function show_brand_ajax($cartegory_id){
            $query = "SELECT * FROM tbl_brand WHERE cartegory_id = '$cartegory_id' ";
            $result = $this ->db->select($query);
            return $result;
        }
        // ---------------------Nhap thong tin---------------------
        public function insert_product(){
            $product_name = $_POST['product_name'];
            $cartegory_id = isset($_POST['cartegory_id']) ? $_POST['cartegory_id'] : null;
            $brand_id = $_POST['brand_id'];
            $product_price = $_POST['product_price'];
            $product_price_new = $_POST['product_price_new'];
            $product_desc = $_POST['product_desc'];
            $product_img = $_FILES['product_img']['name'];
            move_uploaded_file($_FILES['product_img']['tmp_name'],"uploads/".$_FILES['product_img']['name']);
            $query = "INSERT INTO tbl_product(
            product_name,
            cartegory_id,
            brand_id,
            product_price,
            product_price_new,
            product_desc,
            product_img) values
            ('$product_name',
            '$cartegory_id',
            '$brand_id',
            '$product_price',
            '$product_price_new',
            '$product_desc',
            '$product_img')";
            $result = $this ->db->insert($query);
            if($result){
                $query = "SELECT * FROM tbl_product ORDER BY product_id DESC LIMIT 1";
                $result = $this -> db ->select($query)-> fetch_assoc();
                $product_id = $result['product_id'];
                $filename = $_FILES['product_img_desc']['name'];
                $filetmp = $_FILES['product_img_desc']['tmp_name'];
                foreach($filename as $key => $value){
                    move_uploaded_file($filetmp[$key],"uploads/".$value);
                    $query = "INSERT INTO tbl_product_img_desc(product_id,product_img_desc) VALUES ('$product_id','$value') ";
                    $result = $this ->db->insert($query);
                }


            }


            // header('location:brandlist.php');
            return $result;
        }
        public function show_product() {
            $query = "SELECT tbl_product.*, tbl_cartegory.cartegory_name, tbl_brand.brand_name 
                      FROM tbl_product 
                      INNER JOIN tbl_cartegory ON tbl_product.cartegory_id = tbl_cartegory.cartegory_id 
                      INNER JOIN tbl_brand ON tbl_product.brand_id = tbl_brand.brand_id 
                      ORDER BY tbl_product.product_id DESC";
            $result = $this->db->select($query);
            return $result;
        }
        



















        
        // ---------------------Lấy thông tin danh mục---------------------
        public function get_cartegory($cartegory_id){
            $query = "SELECT * FROM tbl_cartegory WHERE cartegory_id = '$cartegory_id' ";
            $result = $this ->db->select($query);
            return $result;
        }
        // ---------------------Lấy thông tin loại sản phẩm---------------------
        public function get_product($product_id) {
            $query = "SELECT * FROM tbl_product WHERE product_id = '$product_id'";
            return $this->db->select($query);
        }
        
        // ---------------------Update danh mục ---------------------
        public function update_cartegory($cartegory_name,$cartegory_id){
            $query = "UPDATE tbl_cartegory SET cartegory_name = '$cartegory_name' WHERE cartegory_id = '$cartegory_id'";
            $result = $this ->db->update($query);
            header('location:cartegorylist.php');
            return $result;
        }
        // ---------------------Update danh loại sản phẩm ---------------------
        public function update_product($product_id, $post, $files) {
            $product_name = $post['product_name'];
            $cartegory_id = $post['cartegory_id'];
            $brand_id = $post['brand_id'];
            $product_price = str_replace('.', '', $post['product_price']);
            $product_price_new = str_replace('.', '', $post['product_price_new']);
            $product_desc = $post['product_desc'];
        
            if (!empty($files['product_img']['name'])) {
                $product_img = $files['product_img']['name'];
                move_uploaded_file($files['product_img']['tmp_name'], "uploads/".$product_img);
                $query = "UPDATE tbl_product SET
                    product_name = '$product_name',
                    cartegory_id = '$cartegory_id',
                    brand_id = '$brand_id',
                    product_price = '$product_price',
                    product_price_new = '$product_price_new',
                    product_desc = '$product_desc',
                    product_img = '$product_img'
                    WHERE product_id = '$product_id'";
            } else {
                $query = "UPDATE tbl_product SET
                    product_name = '$product_name',
                    cartegory_id = '$cartegory_id',
                    brand_id = '$brand_id',
                    product_price = '$product_price',
                    product_price_new = '$product_price_new',
                    product_desc = '$product_desc'
                    WHERE product_id = '$product_id'";
            }
        
            $result = $this->db->update($query);
            header('Location: productlist.php');
            return $result;
        }
        
        // ---------------------Delete danh loại sản phẩm ---------------------
        public function delete_product($product_id) {
            // Xóa ảnh mô tả trước (nếu có)
            $query = "DELETE FROM tbl_product_img_desc WHERE product_id = '$product_id'";
            $this->db->delete($query);
        
            // Xóa sản phẩm chính
            $query = "DELETE FROM tbl_product WHERE product_id = '$product_id'";
            $result = $this->db->delete($query);
        
            header('Location: productlist.php');
            return $result;
        }
        

    }





?>