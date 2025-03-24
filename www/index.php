<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "Test1";

// Kết nối CSDL
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

// Truy vấn danh sách sinh viên
$sql = "SELECT * FROM SinhVien";
$result = $conn->query($sql);

// Kiểm tra lỗi truy vấn
if (!$result) {
    die("Lỗi truy vấn: " . $conn->error);
}

?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh Sách Sinh Viên</title>
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
        .student-img {
            width: 60px;
            height: 60px;
            object-fit: cover;
            border-radius: 50%;
        }
    </style>
</head>
<body>

    <!-- Thanh điều hướng -->
    <nav class="navbar navbar-dark bg-dark navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand" href="#">Test1</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item"><a class="nav-link active" href="#">Sinh Viên</a></li>
                    <li class="nav-item"><a class="nav-link" href="hocphan.php">Học Phần</a></li>
                    <li class="nav-item"><a class="nav-link" href="dangky.php">Đăng Ký</a></li>
                    <li class="nav-item"><a class="nav-link" href="dangnhap.php">Đăng Nhập</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Nội dung trang -->
    <div class="container mt-4">
        <div class="btn-add mb-3">
            <h2 class="text-primary">📖 Danh Sách Sinh Viên</h2>
            <a href="create.php" class="btn btn-success">➕ Thêm Sinh Viên</a>
        </div>

        <!-- Ô tìm kiếm -->
        <input class="form-control mb-3" id="searchInput" type="text" placeholder="🔍 Tìm kiếm sinh viên...">

        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>Mã SV</th>
                        <th>Họ Tên</th>
                        <th>Giới Tính</th>
                        <th>Ngày Sinh</th>
                        <th>Hình</th>
                        <th>Mã Ngành</th>
                        <th>Hành Động</th>
                    </tr>
                </thead>
                <tbody id="studentTable">
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['MaSV']); ?></td>
                            <td><?php echo htmlspecialchars($row['HoTen']); ?></td>
                            <td><?php echo htmlspecialchars($row['GioiTinh']); ?></td>
                            <td><?php echo htmlspecialchars($row['NgaySinh']); ?></td>
                            <td><img src="<?php echo $row['Hinh']; ?>" alt="Hình sinh viên" class="student-img"></td>
                            <td><?php echo htmlspecialchars($row['MaNganh']); ?></td>
                            <td>
                                <a href="edit.php?id=<?php echo $row['MaSV']; ?>" class="btn btn-warning btn-sm">✏️ Sửa</a>
                                <a href="detail.php?id=<?php echo $row['MaSV']; ?>" class="btn btn-info btn-sm">🔍 Chi Tiết</a>
                                <a href="delete.php?id=<?php echo $row['MaSV']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Bạn có chắc chắn muốn xóa?');">🗑️ Xóa</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Script tìm kiếm -->
    <script>
        document.getElementById("searchInput").addEventListener("keyup", function() {
            var input = this.value.toLowerCase();
            var rows = document.querySelectorAll("#studentTable tr");
            
            rows.forEach(function(row) {
                var text = row.innerText.toLowerCase();
                row.style.display = text.includes(input) ? "" : "none";
            });
        });
    </script>

</body>
</html>

<?php
$conn->close();
?>
