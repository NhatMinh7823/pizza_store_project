<?php
require_once '../config.php';
require_once '../models/Product.php';

// Khởi tạo đối tượng Product
$productModel = new Product($conn);

// Lấy tất cả danh mục sản phẩm
$categories = $productModel->getCategories();

// Lấy danh mục người dùng chọn (nếu có)
$category_id = isset($_GET['category_id']) ? $_GET['category_id'] : null;

// Nếu người dùng chọn danh mục, hiển thị sản phẩm thuộc danh mục đó
if ($category_id) {
    $products = $productModel->getProductsByCategory($category_id);
} else {
    // Nếu không chọn danh mục, hiển thị tất cả sản phẩm
    $products = $productModel->getAllProducts();
}
?>

<h1 class="text-center mt-4">Our Pizza Menu</h1>

<!-- Phân loại sản phẩm -->
<div class="text-center mb-4">
    <a href="/index.php?page=products" class="btn btn-primary m-1">All</a> <!-- Nút "All" để xem tất cả sản phẩm -->
    <?php foreach ($categories as $category): ?>
        <a href="/index.php?page=products&category_id=<?= $category['id'] ?>" class="btn btn-outline-primary m-1">
            <?= htmlspecialchars($category['name']) ?>
        </a>
    <?php endforeach; ?>
</div>

<!-- Danh sách sản phẩm -->
<div class="container">
    <div class="row">
        <?php if (!empty($products)): ?>
            <?php foreach ($products as $product): ?>
                <div class="col-md-4">
                    <div class="card mb-4">
                        <img class="card-img-top" src="/images/<?= htmlspecialchars($product['image']) ?>"
                            alt="<?= htmlspecialchars($product['name']) ?>">
                        <div class="card-body">
                            <h5 class="card-title"><?= htmlspecialchars($product['name']) ?></h5>
                            <p class="card-text"><?= htmlspecialchars($product['description']) ?></p>
                            <p class="card-text text-danger">$<?= htmlspecialchars($product['price']) ?></p>
                            <a href="/index.php?page=product_detail&id=<?= $product['id'] ?>" class="btn btn-primary">View
                                Details</a>
                            <a href="/index.php?page=cart&action=add&product_id=<?= $product['id'] ?>"
                                class="btn btn-warning">Add to Cart</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p class="text-center">No products found.</p>
        <?php endif; ?>
    </div>
</div>