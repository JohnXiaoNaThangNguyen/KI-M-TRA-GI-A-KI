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

// Cập nhật thông tin sinh viên
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $MaSV = $_POST['MaSV'];
    $HoTen = $_POST['HoTen'];
    $GioiTinh = $_POST['GioiTinh'];
    $NgaySinh = $_POST['NgaySinh'];
    $Hinh = $_POST['Hinh'];
    $MaNganh = $_POST['MaNganh'];
    
    $sql = "UPDATE SinhVien SET HoTen='$HoTen', GioiTinh='$GioiTinh', NgaySinh='$NgaySinh', Hinh='$Hinh', MaNganh='$MaNganh' WHERE MaSV='$MaSV'";
    
    if ($conn->query($sql) === TRUE) {
        header("Location: index.php?updated=success");
        exit();
    } else {
        echo "Lỗi: " . $conn->error;
    }
}

// Lấy thông tin sinh viên
if (isset($_GET['id'])) {
    $MaSV = $_GET['id'];
    $sql = "SELECT * FROM SinhVien WHERE MaSV='$MaSV'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
} else {
    echo "Không tìm thấy sinh viên.";
    exit();
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chỉnh sửa Sinh Viên</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        body {
            background-color: #f8f9fa;
        }
        .edit-box {
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            border-radius: 10px;
            background: white;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        }
        .student-img {
            width: 150px;
            height: 150px;
            border-radius: 10px;
            object-fit: cover;
            border: 3px solid #dee2e6;
        }
        .btn-primary {
            transition: all 0.3s ease-in-out;
        }
        .btn-primary:hover {
            background-color: #0056b3;
            transform: scale(1.05);
        }
        .btn-secondary:hover {
            transform: scale(1.05);
        }
    </style>
</head>
<body>

<div class="container">
    <div class="edit-box">
        <h2 class="text-center text-primary">📝 Chỉnh sửa Sinh Viên</h2>
        <form method="post">
            <input type="hidden" name="MaSV" value="<?php echo $row['MaSV']; ?>">
            <div class="mb-3">
                <label class="form-label">Họ Tên</label>
                <input type="text" name="HoTen" class="form-control" value="<?php echo htmlspecialchars($row['HoTen']); ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Giới Tính</label>
                <select name="GioiTinh" class="form-select">
                    <option value="Nam" <?php if($row['GioiTinh'] == 'Nam') echo 'selected'; ?>>Nam</option>
                    <option value="Nữ" <?php if($row['GioiTinh'] == 'Nữ') echo 'selected'; ?>>Nữ</option>
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Ngày Sinh</label>
                <input type="date" name="NgaySinh" class="form-control" value="<?php echo htmlspecialchars($row['NgaySinh']); ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Hình</label>
                <input type="text" name="Hinh" class="form-control" value="<?php echo htmlspecialchars($row['Hinh']); ?>">
                <div class="text-center mt-3">
                    <img src="<?php echo htmlspecialchars($row['Hinh']); ?>" class="student-img" alt="Hình sinh viên">
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label">Mã Ngành</label>
                <input type="text" name="MaNganh" class="form-control" value="<?php echo htmlspecialchars($row['MaNganh']); ?>" required>
            </div>
            <div class="text-center">
                <button type="submit" class="btn btn-primary">💾 Lưu</button>
                <a href="index.php" class="btn btn-secondary">❌ Hủy</a>
            </div>
        </form>
    </div>
</div>

</body>
</html>
