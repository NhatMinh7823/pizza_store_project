<!-- pages/login.php -->
<div class="container my-5">
  <h1>Login</h1>
  <form method="POST" action="/index.php?page=login">
    <div class="form-group">
      <label for="email">Email:</label>
      <input type="email" class="form-control" id="email" name="email" required>
    </div>
    <div class="form-group">
      <label for="password">Password:</label>
      <input type="password" class="form-control" id="password" name="password" required>
    </div>
    <button type="submit" class="btn btn-primary">Login</button>
  </form>
</div>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  require_once '../config.php';

  // Xử lý đăng nhập
  $email = $_POST['email'];
  $password = $_POST['password'];

  $stmt = $conn->prepare("SELECT * FROM users WHERE email = :email");
  $stmt->execute(['email' => $email]);
  $user = $stmt->fetch(PDO::FETCH_ASSOC);

  if ($user && password_verify($password, $user['password'])) {
    // Đăng nhập thành công
    $_SESSION['user'] = $user['name'];
    header("Location: /index.php?page=home");
  } else {
    echo "<p>Invalid credentials. Please try again.</p>";
  }
}
?>