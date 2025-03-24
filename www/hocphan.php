<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "Test1";

// Kết nối CSDL
$conn = new mysqli($servername, $username, $password, $dbname);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

// Truy vấn danh sách học phần
$sql = "SELECT MaHocPhan, TenHocPhan, SoTinChi FROM HocPhan";
$result = $conn->query($sql);

// Kiểm tra truy vấn có dữ liệu không
if (!$result) {
    die("Lỗi truy vấn: " . $conn->error);
}

?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách học phần</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        body {
            background-color: #f8f9fa;
        }
        .table-hover tbody tr:hover {
            background-color: #f1f1f1;
        }
        .btn-add {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .table thead {
            background-color: #007bff;
            color: white;
        }
        .table tbody tr:nth-child(even) {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <div class="container mt-4">
        <div class="btn-add mb-3">
            <h2 class="text-primary">📚 Danh sách học phần</h2>
            <a href="them_hoc_phan.php" class="btn btn-success">➕ Thêm học phần</a>
        </div>
        
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>Mã Học Phần</th>
                        <th>Tên Học Phần</th>
                        <th>Số Tín Chỉ</th>
                        <th>Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['MaHocPhan']); ?></td>
                            <td><?php echo htmlspecialchars($row['TenHocPhan']); ?></td>
                            <td><?php echo htmlspecialchars($row['SoTinChi']); ?></td>
                            <td>
                                <a href="sua_hoc_phan.php?id=<?php echo $row['MaHocPhan']; ?>" class="btn btn-warning btn-sm">✏️ Sửa</a>
                                <a href="xoa_hoc_phan.php?id=<?php echo $row['MaHocPhan']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Bạn có chắc chắn muốn xóa?');">🗑️ Xóa</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>

<?php
$conn->close();
?>
