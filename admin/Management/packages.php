<?php
include '../admin_header.php';
require_once '../../config/database.php';
if (!isset($pdo)) {
    die('PDO connection not found. Please check database.php');
}

// Message variable
$msg     = '';
// Add package
if (isset($_POST['add'])) {
    $name = $_POST['Name_Package'] ?? '';
    $destination = $_POST['Destination'] ?? '';
    $category_id = isset($_POST['category_id']) ? $_POST['category_id'] : null;
    $max_people = $_POST['max_people'] ?? '';
    $duration = $_POST['duration'] ?? '';
    $price = $_POST['price'] ?? '';
    $img_id = $_POST['img_id'] ?? '';
    if ($category_id === null || $category_id === '') {
        $msg = 'Please select a tour category!';
    } else {
    $stmt = $pdo->prepare("INSERT INTO packages (Name_Package, Destination, category_id, max_people, duration, price, img_id) VALUES (?, ?, ?, ?, ?, ?, ?)");
    if ($stmt->execute([$name, $destination, $category_id, $max_people, $duration, $price, $img_id])) {
            $msg = 'Added successfully!';
        } else {
            $msg = 'Error while adding!';
        }
    }
}
// Edit package
if (isset($_POST['edit'])) {
    $id = $_POST['id'];
    $name = $_POST['Name_Package'];
    $destination = $_POST['Destination'];
    $category_id = $_POST['category_id'];
    $max_people = $_POST['max_people'];
    $duration = $_POST['duration'];
    $price = $_POST['price'];
    $img_id = $_POST['img_id'];
    $stmt = $pdo->prepare("UPDATE packages SET Name_Package=?, Destination=?, category_id=?, max_people=?, duration=?, price=?, img_id=? WHERE id=?");
    if ($stmt->execute([$name, $destination, $category_id, $max_people, $duration, $price, $img_id, $id])) {
        $msg = 'Updated successfully!';
    } else {
        $msg = 'Error while updating!';
    }
}
// Delete package
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $stmt = $pdo->prepare("DELETE FROM packages WHERE id=?");
    $stmt->execute([$id]);
    $msg = 'Deleted!';
}

// Get packages and images_url list
$packages = $pdo->query("SELECT p.*, c.category_tours, i.image_url FROM packages p LEFT JOIN category c ON p.category_id = c.id LEFT JOIN images_url i ON p.img_id = i.id")->fetchAll(PDO::FETCH_ASSOC);
$images = $pdo->query("SELECT * FROM images_url")->fetchAll(PDO::FETCH_ASSOC);
$categories = $pdo->query("SELECT * FROM category")->fetchAll(PDO::FETCH_ASSOC);

// If editing, get old data
$editData = null;
if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $stmt = $pdo->prepare("SELECT * FROM packages WHERE id=?");
    $stmt->execute([$id]);
    $editData = $stmt->fetch(PDO::FETCH_ASSOC);
}
?>
<div class="container mt-4">
    <h2 class="mb-4">Manage Tour Packages</h2>
    <?php if ($msg): ?>
    <div class="alert alert-info"> <?= $msg ?> </div>
    <?php endif; ?>
    <form method="post" class="row g-3 mb-4">
        <?php if ($editData): ?>
        <input type="hidden" name="id" value="<?= $editData['id'] ?>">
        <?php endif; ?>

        <div class="col-md-3">
            <label class="form-label">Package Name</label>
            <input type="text" name="Name_Package" class="form-control" required
                value="<?= $editData['Name_Package'] ?? '' ?>">
        </div>
        <div class="col-md-3">
            <label class="form-label">Destination</label>
            <input type="text" name="Destination" class="form-control" required
                value="<?= $editData['Destination'] ?? '' ?>">
        </div>
        <div class="col-md-3">
            <label class="form-label">Tour Category</label>
            <select name="category_id" class="form-select" required>
                <option value="">--Select tour category--</option>
                <?php foreach ($categories as $cat): ?>
                <option value="<?= $cat['id'] ?>"
                    <?= (isset($editData['category_id']) && $editData['category_id'] == $cat['id']) ? 'selected' : '' ?>>
                    <?= htmlspecialchars($cat['category_tours']) ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="col-md-2">
            <label class="form-label">Max People</label>
            <input type="number" name="max_people" class="form-control" required
                value="<?= $editData['max_people'] ?? '' ?>">
        </div>
        <div class="col-md-2">
            <label class="form-label">Duration (days)</label>
            <input type="number" name="duration" class="form-control" required min="1"
                value="<?= $editData['duration'] ?? '' ?>">
        </div>
        <div class="col-md-2">
            <label class="form-label">Price</label>
            <input type="number" name="price" class="form-control" required value="<?= $editData['price'] ?? '' ?>">
        </div>
        <div class="col-md-3">
            <label class="form-label">Thumbnail Image</label>
            <select name="img_id" class="form-select" required>
                <option value="">--Select image--</option>
                <?php foreach ($images as $img): ?>
                <option value="<?= $img['id'] ?>"
                    <?= (isset($editData['img_id']) && $editData['img_id'] == $img['id']) ? 'selected' : '' ?>>
                    <?= $img['image_url'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="col-md-2 align-self-end">
            <button type="submit" name="<?= $editData ? 'edit' : 'add' ?>"
                class="btn btn-<?= $editData ? 'warning' : 'primary' ?> w-100">
                <?= $editData ? 'Update' : 'Add New' ?>
            </button>
        </div>
        <?php if ($editData): ?>
        <div class="col-md-2 align-self-end">
            <a href="packages.php" class="btn btn-secondary w-100">Cancel</a>
        </div>
        <?php endif; ?>
    </form>
    <div class="table-responsive">
        <table class="table table-bordered table-hover">
            <thead class="table-primary">
                <tr>
                    <th>ID</th>
                    <th>Package Name</th>
                    <th>Destination</th>
                    <th>Tour Category</th>
                    <th>Max People</th>
                    <th>Duration (days)</th>
                    <th>Price</th>
                    <th>Image</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($packages as $p): ?>
                <tr>
                    <td><?= $p['id'] ?></td>
                    <td><?= htmlspecialchars($p['Name_Package']) ?></td>
                    <td><?= htmlspecialchars($p['Destination']) ?></td>
                    <td><?= htmlspecialchars($p['category_tours'] ?? '') ?></td>
                    <td><?= $p['max_people'] ?></td>
                    <td><?= $p['duration'] ?></td>
                    <td><?= number_format($p['price']) ?></td>
                    <td>
                        <?php if (!empty($p['image_url'])): ?>
                        <img src="../../<?= $p['image_url'] ?>" alt="img"
                            style="width:60px;height:40px;object-fit:cover;">
                        <?php endif; ?>
                    </td>
                    <td>
                        <a href="packages.php?edit=<?= $p['id'] ?>" class="btn btn-sm btn-warning">Edit</a>
                        <a href="packages.php?delete=<?= $p['id'] ?>" class="btn btn-sm btn-danger"
                            onclick="return confirm('Delete this tour package?')">Delete</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>