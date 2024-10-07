<!-- pages/register.php -->
<div class="container my-5">
  <h1>Register</h1>
  <form method="POST" action="/index.php?page=register">
    <div class="form-group">
      <label for="name">Full Name:</label>
      <input type="text" class="form-control" id="name" name="name" required>
    </div>
    <div class="form-group">
      <label for="email">Email:</label>
      <input type="email" class="form-control" id="email" name="email" required>
    </div>
    <div class="form-group">
      <label for="password">Password:</label>
      <input type="password" class="form-control" id="password" name="password" required>
    </div>
    <button type="submit" class="btn btn-primary">Register</button>
  </form>
</div>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require_once '../config.php';

    // Xử lý đăng ký
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Thêm người dùng mới vào CSDL
    $stmt = $conn->prepare("INSERT INTO users (name, email, password) VALUES (:name, :email, :password)");
    $stmt->execute(['name' => $name, 'email' => $email, 'password' => $password]);

    echo "<p>Registration successful! Please <a href='/index.php?page=login'>login</a>.</p>";
}
?>