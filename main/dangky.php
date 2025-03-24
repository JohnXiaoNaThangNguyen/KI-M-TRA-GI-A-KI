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

// Kiểm tra nếu 'id' tồn tại trong URL
if (!isset($_GET['id']) || empty($_GET['id'])) {
    header("Location: index.php");
    exit();
}

$id = $_GET['id'];

// Truy vấn để lấy thông tin học phần
$sql = "SELECT * FROM HocPhan WHERE MaHocPhan = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
} else {
    die("<div class='alert alert-danger text-center'>❌ Lỗi: Không tìm thấy học phần.</div>");
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng Ký Học Phần</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        body {
            background-color: #f8f9fa;
        }
        .card {
            max-width: 500px;
            margin: 50px auto;
            border-radius: 15px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        }
        .table th {
            background-color: #007bff;
            color: white;
        }
        .btn {
            border-radius: 10px;
            transition: all 0.3s ease-in-out;
        }
        .btn-primary:hover {
            background-color: #0056b3;
            transform: scale(1.05);
        }
    </style>
</head>
<body>

<div class="card">
    <div class="card-body">
        <h3 class="text-center mb-4">📚 ĐĂNG KÝ HỌC PHẦN</h3>
        <table class="table table-bordered">
            <tr>
                <th>📌 Mã Học Phần</th>
                <td><?php echo htmlspecialchars($row['MaHocPhan']); ?></td>
            </tr>
            <tr>
                <th>📖 Tên Học Phần</th>
                <td><?php echo htmlspecialchars($row['TenHocPhan']); ?></td>
            </tr>
            <tr>
                <th>🎓 Số Tín Chỉ</th>
                <td><?php echo htmlspecialchars($row['SoTinChi']); ?></td>
            </tr>
        </table>
        <a href="index.php" class="btn btn-primary w-100">🔙 Quay Lại</a>
    </div>
</div>

</body>
</html>

<?php
$stmt->close();
$conn->close();
?>
