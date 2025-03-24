<?php
session_start();
include 'db.php';

if (!isset($_SESSION['MaSV'])) {
    header("Location: login.php");
    exit();
}

$MaSV = $_SESSION['MaSV'];

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['hocphan'])) {
    $hocphans = $_POST['hocphan'];

    // Tạo đăng ký mới
    $sql = "INSERT INTO dangky (NgayDK, MaSV) VALUES (NOW(), '$MaSV')";
    $conn->query($sql);
    $MaDK = $conn->insert_id;

    // Lưu các học phần đã chọn vào ChiTietDangKy
    foreach ($hocphans as $MaHP) {
        $sql = "INSERT INTO chitietdangky (MaDK, MaHP) VALUES ('$MaDK', '$MaHP')";
        $conn->query($sql);
    }

    // Chuyển hướng đến trang giỏ hàng
    header("Location: cart_view.php");
    exit();
} 
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng ký học phần</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="alert alert-warning text-center" role="alert">
            <h4 class="alert-heading">Bạn chưa chọn học phần nào!</h4>
            <p>Vui lòng quay lại và chọn học phần để đăng ký.</p>
            <a href='hocphan.php' class="btn btn-primary">Quay lại</a>
        </div>
    </div>
</body>
</html>
