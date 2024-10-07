<?php include('../includes/config.php');

function getProductById($id) {
  global $conn;
  $stmt = $conn->prepare("SELECT * FROM products WHERE id = :id");
  $stmt->execute(['id' => $id]);
  return $stmt->fetch(PDO::FETCH_ASSOC);
}