<?php
include '../admin_header.php';
require_once '../../config/database.php';
// Use correct $pdo variable from database.php
if (!isset($pdo)) {
    die('PDO connection not found. Please check database.php');
}

// Handle add, edit, delete
$msg = '';
if (isset($_POST['add'])) {
    $category = $_POST['category_tours'];
    $img_id = $_POST['img_id'];
    $stmt = $pdo->prepare("INSERT INTO category (category_tours, img_id) VALUES (?, ?)");
    if ($stmt->execute([$category, $img_id])) {
        $msg = 'Added successfully!';
    } else {
        $msg = 'Error while adding!';
    }
}
if (isset($_POST['edit'])) {
    $id = $_POST['id'];
    $category = $_POST['category_tours'];
    $img_id = $_POST['img_id'];
    $stmt = $pdo->prepare("UPDATE category SET category_tours=?, img_id=? WHERE id=?");
    if ($stmt->execute([$category, $img_id, $id])) {
        $msg = 'Updated successfully!';
    } else {
        $msg = 'Error while updating!';
    }
}
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $stmt = $pdo->prepare("DELETE FROM category WHERE id=?");
    $stmt->execute([$id]);
    $msg = 'Deleted!';
}

// Get category and images_url list
$categories = $pdo->query("SELECT c.*, i.image_url FROM category c LEFT JOIN images_url i ON c.img_id = i.id")->fetchAll(PDO::FETCH_ASSOC);
$images = $pdo->query("SELECT * FROM images_url")->fetchAll(PDO::FETCH_ASSOC);

// If editing, get old data
$editData = null;
if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $stmt = $pdo->prepare("SELECT * FROM category WHERE id=?");
    $stmt->execute([$id]);
    $editData = $stmt->fetch(PDO::FETCH_ASSOC);
}
?>
<div class="container mt-4">
    <h2 class="mb-4">Tour Category & Image Management</h2>
    <?php if ($msg): ?>
    <div class="alert alert-info"> <?= $msg ?> </div>
    <?php endif; ?>
    <form method="post" class="row g-3 mb-4">
        <?php if ($editData): ?>
        <input type="hidden" name="id" value="<?= $editData['id'] ?>">
        <?php endif; ?>
        <div class="col-md-5">
            <label class="form-label">Tour Category Name</label>
            <input type="text" name="category_tours" class="form-control" required
                value="<?= $editData['category_tours'] ?? '' ?>">
        </div>
        <div class="col-md-5">
            <label class="form-label">Select Image</label>
            <select name="img_id" class="form-select" required>
                <option value="">-- Select Image --</option>
                <?php foreach ($images as $img): ?>
                <option value="<?= $img['id'] ?>"
                    <?= (isset($editData) && $editData['img_id'] == $img['id']) ? 'selected' : '' ?>>
                    <?= $img['image_url'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="col-md-2 d-flex align-items-end">
            <?php if ($editData): ?>
            <button type="submit" name="edit" class="btn btn-warning w-100">Update</button>
            <a href="Category.php" class="btn btn-secondary ms-2">Cancel</a>
            <?php else: ?>
            <button type="submit" name="add" class="btn btn-primary w-100">Add New</button>
            <?php endif; ?>
        </div>
    </form>
    <table class="table table-bordered table-hover align-middle">
        <thead class="table-light">
            <tr>
                <th>ID</th>
                <th>Tour Category Name</th>
                <th>Image</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($categories as $cat): ?>
            <tr>
                <td><?= $cat['id'] ?></td>
                <td><?= htmlspecialchars($cat['category_tours']) ?></td>
                <td>
                    <?php if ($cat['image_url']): ?>
                    <img src="../../<?= $cat['image_url'] ?>" alt="img" style="max-width:80px;max-height:60px;">
                    <?php endif; ?>
                </td>
                <td>
                    <a href="?edit=<?= $cat['id'] ?>" class="btn btn-sm btn-warning">Edit</a>
                    <a href="?delete=<?= $cat['id'] ?>" class="btn btn-sm btn-danger"
                        onclick="return confirm('Delete this item?')">Delete</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>