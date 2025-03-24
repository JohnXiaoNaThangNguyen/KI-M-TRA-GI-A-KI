<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "Test1";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Lỗi kết nối CSDL: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $masv = $_POST['masv'];
    $sql = "SELECT * FROM SinhVien WHERE MaSV = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $masv);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $_SESSION['masv'] = $masv;
        header("Location: dashboard.php");
        exit();
    } else {
        $error = "❌ Mã sinh viên không hợp lệ!";
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng Nhập</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        body {
            background-color: #f8f9fa;
        }
        .login-card {
            max-width: 400px;
            margin: 80px auto;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        }
        .btn {
            border-radius: 8px;
            transition: all 0.3s ease-in-out;
        }
        .btn-primary:hover {
            background-color: #0056b3;
            transform: scale(1.05);
        }
        .error-msg {
            color: red;
            font-weight: bold;
            margin-top: 10px;
            text-align: center;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="#">Test1</a>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link" href="#">Sinh Viên</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Học Phần</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Đăng Ký</a></li>
                <li class="nav-item"><a class="nav-link active" href="#">Đăng Nhập</a></li>
            </ul>
        </div>
    </div>
</nav>

<div class="container">
    <div class="login-card bg-white p-4 shadow rounded">
        <h3 class="text-center mb-3">🔑 ĐĂNG NHẬP</h3>
        <form method="POST">
            <div class="mb-3">
                <label for="masv" class="form-label">📌 Mã Sinh Viên</label>
                <input type="text" class="form-control" id="masv" name="masv" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">🚀 Đăng Nhập</button>
        </form>
        <?php if (isset($error)) { echo "<p class='error-msg'>$error</p>"; } ?>
        <a href="index.php" class="d-block text-center mt-3">🔙 Quay Lại Trang Chủ</a>
    </div>
</div>

</body>
</html>

<?php
$conn->close();
?>
