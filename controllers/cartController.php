<?php // controllers/cartController.php
session_start();

// Hàm lấy danh sách sản phẩm trong giỏ hàng
function getCartItems() {
  return isset($_SESSION['cart']) ? $_SESSION['cart'] : [];
}

// Thêm sản phẩm vào giỏ hàng
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $product_id = $_POST['product_id'];
  $quantity = $_POST['quantity'];

  // Lấy thông tin sản phẩm từ database
  include('productController.php');
  $product = getProductById($product_id);

  // Thêm vào session giỏ hàng
  if (!isset($_SESSION['cart'][$product_id])) {
    $_SESSION['cart'][$product_id] = [
      'id' => $product['id'],
      'name' => $product['name'],
      'price' => $product['price'],
      'quantity' => $quantity
    ];
  } else {
    $_SESSION['cart'][$product_id]['quantity'] += $quantity;
  }

  header('Location: ../pages/cart.php');
}

// Xóa sản phẩm khỏi giỏ hàng
if (isset($_POST['action']) && $_POST['action'] == 'remove') {
  $product_id = $_POST['product_id'];
  unset($_SESSION['cart'][$product_id]);
  header('Location: ../pages/cart.php');
}