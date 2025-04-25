<?php
    include "database.php";
?>
<?php
    class brand{
        private $db;

        public function __construct()
        {
            $this -> db = new Database();
        }
        // ---------------------Nhap thong tin---------------------
        public function insert_brand($cartegory_id,$brand_name){
            $query = "INSERT INTO tbl_brand(cartegory_id,brand_name) values ('$cartegory_id','$brand_name')";
            $result = $this ->db->insert($query);
            // header('location:cartegorylist.php');
            return $result;
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
        // ---------------------Lấy thông tin danh mục---------------------
        public function get_cartegory($cartegory_id){
            $query = "SELECT * FROM tbl_cartegory WHERE cartegory_id = '$cartegory_id' ";
            $result = $this ->db->select($query);
            return $result;
        }
        // ---------------------Lấy thông tin loại sản phẩm---------------------
        public function get_brand($brand_id){
            $query = "SELECT * FROM tbl_brand WHERE brand_id = '$brand_id' ";
            $result = $this ->db->select($query);
            return $result;
        }
        // ---------------------Update danh mục ---------------------
        public function update_cartegory($cartegory_name,$cartegory_id){
            $query = "UPDATE tbl_cartegory SET cartegory_name = '$cartegory_name' WHERE cartegory_id = '$cartegory_id'";
            $result = $this ->db->update($query);
            header('location:cartegorylist.php');
            return $result;
        }
        // ---------------------Update danh loại sản phẩm ---------------------
        public function update_brand($cartegory_id,$brand_name,$brand_id){
            $query = "UPDATE tbl_brand SET brand_name = '$brand_name',cartegory_id ='$cartegory_id' WHERE brand_id = '$brand_id'";
            $result = $this ->db->update($query);
            header('location:brandlist.php');
            return $result;
        }
        // ---------------------Delete danh loại sản phẩm ---------------------
        public function delete_brand($brand_id){
            $query = "DELETE FROM tbl_brand WHERE brand_id = '$brand_id' ";
            $result = $this ->db->delete($query);
            header('location:brandlist.php');
            return $result;
        }

    }





?>