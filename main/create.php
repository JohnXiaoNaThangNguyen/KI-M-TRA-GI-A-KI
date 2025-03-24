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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $MaSV = $_POST['MaSV'];
    $HoTen = $_POST['HoTen'];
    $GioiTinh = $_POST['GioiTinh'];
    $NgaySinh = $_POST['NgaySinh'];
    $Hinh = $_POST['Hinh'];
    $MaNganh = $_POST['MaNganh'];
    
    $sql = "INSERT INTO SinhVien (MaSV, HoTen, GioiTinh, NgaySinh, Hinh, MaNganh) VALUES ('$MaSV', '$HoTen', '$GioiTinh', '$NgaySinh', '$Hinh', '$MaNganh')";
    
    if ($conn->query($sql) === TRUE) {
        header("Location: index.php");
        exit();
    } else {
        echo "<div class='alert alert-danger'>Lỗi: " . $conn->error . "</div>";
    }
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm Sinh Viên</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        body {
            background-color: #f8f9fa;
        }
        .card {
            max-width: 500px;
            margin: 40px auto;
            border-radius: 15px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        }
        .form-control, .form-select {
            border-radius: 10px;
        }
        .btn {
            border-radius: 10px;
        }
        .btn-primary:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

<div class="card">
    <div class="card-body">
        <h3 class="text-center mb-4">📝 Thêm Sinh Viên</h3>
        <form method="post">
            <div class="mb-3">
                <label class="form-label">📌 Mã SV</label>
                <input type="text" name="MaSV" class="form-control" placeholder="Nhập mã sinh viên" required>
            </div>
            <div class="mb-3">
                <label class="form-label">👤 Họ Tên</label>
                <input type="text" name="HoTen" class="form-control" placeholder="Nhập họ và tên" required>
            </div>
            <div class="mb-3">
                <label class="form-label">⚤ Giới Tính</label>
                <select name="GioiTinh" class="form-select">
                    <option value="Nam">Nam</option>
                    <option value="Nữ">Nữ</option>
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">📅 Ngày Sinh</label>
                <input type="date" name="NgaySinh" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">🖼 Hình</label>
                <input type="text" name="Hinh" class="form-control" placeholder="Nhập URL ảnh đại diện">
            </div>
            <div class="mb-3">
                <label class="form-label">🏫 Mã Ngành</label>
                <input type="text" name="MaNganh" class="form-control" placeholder="Nhập mã ngành" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">✔️ Thêm</button>
            <a href="index.php" class="btn btn-secondary w-100 mt-2">❌ Hủy</a>
        </form>
    </div>
</div>

</body>
</html>
