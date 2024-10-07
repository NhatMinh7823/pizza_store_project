<!-- pages/cart.php -->
<div class="container my-5">
  <h1>Your Cart</h1>
  <table class="table">
    <thead>
      <tr>
        <th>Product</th>
        <th>Quantity</th>
        <th>Price</th>
        <th>Total</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      <?php if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])): ?>
        <?php foreach ($_SESSION['cart'] as $id => $item): ?>
        <tr>
          <td><?php echo $item['name']; ?></td>
          <td>
            <form method="POST" action="/index.php?page=cart">
              <input type="number" name="quantity" value="<?php echo $item['quantity']; ?>" min="1" class="form-control">
              <input type="hidden" name="product_id" value="<?php echo $id; ?>">
              <button type="submit" class="btn btn-secondary mt-2">Update</button>
            </form>
          </td>
          <td>$<?php echo $item['price']; ?></td>
          <td>$<?php echo $item['price'] * $item['quantity']; ?></td>
          <td>
            <a href="/index.php?page=cart&remove=<?php echo $id; ?>" class="btn btn-danger">Remove</a>
          </td>
        </tr>
        <?php endforeach; ?>
      <?php else: ?>
        <tr>
          <td colspan="5">Your cart is empty.</td>
        </tr>
      <?php endif; ?>
    </tbody>
  </table>
  
  <div class="d-flex justify-content-between">
    <a href="/index.php?page=products" class="btn btn-primary">Continue Shopping</a>
    <a href="/index.php?page=checkout" class="btn btn-success">Proceed to Checkout</a>
  </div>
</div>

<?php
// Xử lý cập nhật giỏ hàng
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $product_id = $_POST['product_id'];
    $quantity = $_POST['quantity'];
    
    if (isset($_SESSION['cart'][$product_id])) {
        $_SESSION['cart'][$product_id]['quantity'] = $quantity;
    }

    header("Location: /index.php?page=cart");
    exit;
}

// Xử lý xóa sản phẩm khỏi giỏ hàng
if (isset($_GET['remove'])) {
    $product_id = $_GET['remove'];
    unset($_SESSION['cart'][$product_id]);

    header("Location: /index.php?page=cart");
    exit;
}
?>