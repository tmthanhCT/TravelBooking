<?php
include '../admin_header.php';
require_once '../../config/database.php';
if (!isset($pdo)) {
    die('Không tìm thấy kết nối PDO. Vui lòng kiểm tra lại file database.php');
}

$msg = '';
// Xử lý thêm
if (isset($_POST['add'])) {
    $image_url = $_POST['image_url'];
    $stmt = $pdo->prepare("INSERT INTO images_url (image_url) VALUES (?)");
    if ($stmt->execute([$image_url])) {
        $msg = 'Thêm thành công!';
    } else {
        $msg = 'Lỗi khi thêm!';
    }
}
// Xử lý sửa
if (isset($_POST['edit'])) {
    $id = $_POST['id'];
    $image_url = $_POST['image_url'];
    $stmt = $pdo->prepare("UPDATE images_url SET image_url=? WHERE id=?");
    if ($stmt->execute([$image_url, $id])) {
        $msg = 'Cập nhật thành công!';
    } else {
        $msg = 'Lỗi khi cập nhật!';
    }
}
// Xử lý xóa
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $stmt = $pdo->prepare("DELETE FROM images_url WHERE id=?");
    $stmt->execute([$id]);
    $msg = 'Đã xóa!';
}


// Lấy danh sách ảnh từ bảng và từ thư mục img
$images = $pdo->query("SELECT * FROM images_url")->fetchAll(PDO::FETCH_ASSOC);
$img_folder = '../../img';
$img_files = array_filter(scandir($img_folder), function($f) use ($img_folder) {
    return is_file($img_folder . '/' . $f) && preg_match('/\.(jpg|jpeg|png|gif)$/i', $f);
});
// Lọc ra các ảnh chưa có trong bảng images_url
$used_imgs = array_column($images, 'image_url');
$unused_img_files = array_filter($img_files, function($f) use ($used_imgs) {
    return !in_array('img/' . $f, $used_imgs);
});

// Xử lý upload ảnh mới
if (isset($_POST['upload'])) {
    if (isset($_FILES['new_image']) && $_FILES['new_image']['error'] == 0) {
        $target = $img_folder . '/' . basename($_FILES['new_image']['name']);
        $ext = strtolower(pathinfo($target, PATHINFO_EXTENSION));
        if (in_array($ext, ['jpg', 'jpeg', 'png', 'gif'])) {
            if (move_uploaded_file($_FILES['new_image']['tmp_name'], $target)) {
                echo "<script>window.location.href='image.php?msg=upload';</script>";
                exit;
            } else {
                $msg = 'Không thể upload file!';
            }
        } else {
            $msg = 'Chỉ cho phép file ảnh jpg, jpeg, png, gif!';
        }
    } else {
        $msg = 'Vui lòng chọn file ảnh!';
    }
}

// Nếu sửa thì lấy dữ liệu cũ
$editData = null;
if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $stmt = $pdo->prepare("SELECT * FROM images_url WHERE id=?");
    $stmt->execute([$id]);
    $editData = $stmt->fetch(PDO::FETCH_ASSOC);
}
?>
<div class="container mt-4">
    <h2 class="mb-4">Quản lý hình ảnh packages</h2>
    <?php if ($msg): ?>
    <div class="alert alert-info"> <?= $msg ?> </div>
    <?php endif; ?>
    <!-- Form upload ảnh mới -->
    <form method="post" enctype="multipart/form-data" class="row g-3 mb-4">
        <div class="col-md-8">
            <label class="form-label">Upload ảnh mới vào thư mục img/</label>
            <input type="file" name="new_image" class="form-control" accept="image/*">
        </div>
        <div class="col-md-2 d-flex align-items-end">
            <button type="submit" name="upload" class="btn btn-success w-100">Upload</button>
        </div>
    </form>
    <!-- Form thêm/sửa ảnh từ file chưa dùng -->
    <form method="post" class="row g-3 mb-4">
        <?php if ($editData): ?>
        <input type="hidden" name="id" value="<?= $editData['id'] ?>">
        <?php endif; ?>
        <div class="col-md-8">
            <label class="form-label">Chọn file ảnh từ thư mục img/ (chỉ hiện ảnh chưa dùng)</label>
            <select name="image_url" class="form-select" required>
                <option value="">-- Chọn ảnh --</option>
                <?php if ($editData): // Khi sửa thì cho phép chọn lại tất cả ?>
                <?php foreach ($img_files as $file): ?>
                <?php $val = 'img/' . $file; ?>
                <option value="<?= $val ?>" <?= ($editData['image_url'] == $val) ? 'selected' : '' ?>><?= $val ?>
                </option>
                <?php endforeach; ?>
                <?php else: // Khi thêm chỉ hiện ảnh chưa dùng ?>
                <?php foreach ($unused_img_files as $file): ?>
                <?php $val = 'img/' . $file; ?>
                <option value="<?= $val ?>"><?= $val ?></option>
                <?php endforeach; ?>
                <?php endif; ?>
            </select>
        </div>
        <div class="col-md-2 d-flex align-items-end">
            <?php if ($editData): ?>
            <button type="submit" name="edit" class="btn btn-warning w-100">Cập nhật</button>
            <a href="image.php" class="btn btn-secondary ms-2">Hủy</a>
            <?php else: ?>
            <button type="submit" name="add" class="btn btn-primary w-100">Thêm mới</button>
            <?php endif; ?>
        </div>
    </form>
    <table class="table table-bordered table-hover align-middle">
        <thead class="table-light">
            <tr>
                <th>ID</th>
                <th>Đường dẫn ảnh</th>
                <th>Ảnh</th>
                <th>Thao tác</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($images as $img): ?>
            <tr>
                <td><?= $img['id'] ?></td>
                <td><?= htmlspecialchars($img['image_url']) ?></td>
                <td>
                    <?php if ($img['image_url']): ?>
                    <img src="../../<?= $img['image_url'] ?>" alt="img" style="max-width:80px;max-height:60px;">
                    <?php endif; ?>
                </td>
                <td>
                    <a href="?edit=<?= $img['id'] ?>" class="btn btn-sm btn-warning">Sửa</a>
                    <a href="?delete=<?= $img['id'] ?>" class="btn btn-sm btn-danger"
                        onclick="return confirm('Xóa ảnh này?')">Xóa</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>