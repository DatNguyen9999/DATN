<?php
include "../admin/database.php";
include "../admin/format.php";
include "../admin/session.php";

Session::init();

Session::checkLogin(); // đã đăng nhập thì không vào được trang này

$db = new Database();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user = $_POST['login_user'];
    $pass = $_POST['login_psw'];
    $hashed_pass = password_hash($pass, PASSWORD_DEFAULT);

    $query = "INSERT INTO tbl_login(login_user, login_psw) VALUES ('$user', '$hashed_pass')";
    $insert = $db->insert($query);
    if ($insert) {
        echo "<script>alert('Đăng ký thành công!');window.location='login.php';</script>";
    } else {
        echo "<script>alert('Tài khoản đã tồn tại hoặc có lỗi.');</script>";
    }
}
?>

<!-- HTML form đăng ký -->
<form action="" method="POST">
    <h2>Đăng ký</h2>
    <label>Tên đăng nhập:</label><br>
    <input type="text" name="login_user" required><br>
    <label>Mật khẩu:</label><br>
    <input type="password" name="login_psw" required><br>
    <button type="submit">Đăng ký</button>
</form>
<a href="login.php">Đã có tài khoản? Đăng nhập</a>