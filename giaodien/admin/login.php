<?php
include "../admin/database.php";
include "../admin/session.php";
Session::init();
Session::checkLogin(); // Nếu đã đăng nhập thì chuyển sang index.php

$db = new Database();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user = $_POST['login_user'];
    $pass = $_POST['login_psw'];

    $query = "SELECT * FROM tbl_login WHERE login_user = '$user'";
    $result = $db->select($query);

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($pass, $row['login_psw'])) {
            Session::set("login", true);
            Session::set("login_id", $row['login_id']);
            Session::set("login_user", $row['login_user']);
            header("Location: index.php");
            exit();
        } else {
            echo "<script>alert('Sai mật khẩu');</script>";
        }
    } else {
        echo "<script>alert('Tài khoản không tồn tại');</script>";
    }
}
?>

<!-- HTML form đăng nhập -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng Nhập</title>
    <link rel="stylesheet" href="style1.css"> <!-- Link tới file CSS -->
</head>

<body>
    <div class="login-container">
        <h2>Đăng nhập</h2>
        <form action="" method="POST">
            <input type="text" name="login_user" placeholder="Tên đăng nhập" required>
            <input type="password" name="login_psw" placeholder="Mật khẩu" required>
            <button type="submit">Đăng nhập</button>
        </form>
        <a href="register.php">Chưa có tài khoản? Đăng ký</a>
    </div>
</body>

</html>