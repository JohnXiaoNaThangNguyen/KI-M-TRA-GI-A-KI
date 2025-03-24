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

// Kiểm tra nếu có yêu cầu xóa sinh viên
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete'])) {
    $MaSV = $_POST['id'];
    $sql = "DELETE FROM SinhVien WHERE MaSV='$MaSV'";
    
    if ($conn->query($sql) === TRUE) {
        header("Location: index.php?deleted=success");
        exit();
    } else {
        echo "Lỗi: " . $conn->error;
    }
}

// Hiển thị thông tin sinh viên
$detail = null;
if (isset($_GET['id'])) {
    $MaSV = $_GET['id'];
    $sql = "SELECT * FROM SinhVien WHERE MaSV='$MaSV'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $detail = $result->fetch_assoc();
    }
}
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
        .delete-box {
            max-width: 600px;
            margin: 80px auto;
            padding: 20px;
            border-radius: 10px;
            background: white;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        .student-img {
            width: 150px;
            height: 150px;
            border-radius: 10px;
            object-fit: cover;
            border: 3px solid #dee2e6;
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
    <div class="delete-box">
        <h2 class="text-danger">⚠️ Xác nhận xóa</h2>
        <p>Bạn có chắc chắn muốn xóa sinh viên này không?</p>
        <?php if ($detail) { ?>
            <div class="card shadow-sm mb-3">
                <div class="card-body">
                    <img src="<?php echo $detail['Hinh']; ?>" class="student-img mb-3" alt="Hình sinh viên">
                    <h5 class="card-title"><?php echo htmlspecialchars($detail['HoTen']); ?></h5>
                    <p><strong>Giới tính:</strong> <?php echo htmlspecialchars($detail['GioiTinh']); ?></p>
                    <p><strong>Ngày sinh:</strong> <?php echo htmlspecialchars($detail['NgaySinh']); ?></p>
                    <p><strong>Mã ngành:</strong> <?php echo htmlspecialchars($detail['MaNganh']); ?></p>
                </div>
            </div>
            <form method="post">
                <input type="hidden" name="id" value="<?php echo $MaSV; ?>">
                <button type="submit" name="delete" class="btn btn-danger">🗑 Xóa</button>
                <a href="index.php" class="btn btn-secondary">❌ Hủy</a>
            </form>
        <?php } else { echo "<p class='text-danger'>Không tìm thấy thông tin sinh viên.</p>"; } ?>
    </div>
</div>

</body>
</html>

<?php
$conn->close();
?>
