<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "Test1";

// Kết nối CSDL
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Kiểm tra nếu có ID sinh viên
if (isset($_GET['id'])) {
    $MaSV = $_GET['id'];

    // Nếu xác nhận xóa
    if (isset($_POST['confirm_delete'])) {
        $sql = "DELETE FROM SinhVien WHERE MaSV='$MaSV'";
        if ($conn->query($sql) === TRUE) {
            header("Location: index.php?deleted=success");
            exit();
        } else {
            echo "Lỗi: " . $conn->error;
        }
    }
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Xóa Sinh Viên</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        body {
            background-color: #f8f9fa;
        }
        .confirm-box {
            max-width: 500px;
            margin: 100px auto;
            padding: 20px;
            border-radius: 10px;
            background: white;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        .btn-danger {
            transition: all 0.3s ease-in-out;
        }
        .btn-danger:hover {
            background-color: #c82333;
            transform: scale(1.05);
        }
        .btn-secondary:hover {
            transform: scale(1.05);
        }
    </style>
</head>
<body>

<div class="container">
    <div class="confirm-box">
        <h2 class="text-danger">⚠️ Xác nhận xóa</h2>
        <p>Bạn có chắc chắn muốn xóa sinh viên này không?</p>
        <form method="post">
            <button type="submit" name="confirm_delete" class="btn btn-danger">🗑 Xóa</button>
            <a href="index.php" class="btn btn-secondary">❌ Hủy</a>
        </form>
    </div>
</div>

</body>
</html>
