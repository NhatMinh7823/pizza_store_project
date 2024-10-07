<?php
session_start();
include('../includes/config.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $email = $_POST['email'];
  $password = $_POST['password'];

  // Kiểm tra người dùng trong CSDL
  $stmt = $conn->prepare("SELECT * FROM users WHERE email = :email AND password = :password");
  $stmt->execute(['email' => $email, 'password' => md5($password)]);
  
  if ($stmt->rowCount() > 0) {
    $_SESSION['user'] = $email;
    header('Location: ../pages/account.php');
  } else {
    echo "Invalid credentials!";
  }
}