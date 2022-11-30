<?php
$servername = "localhost";
$db = "php_blog-site";
$username = "root";
$password = "";

try {
  $pdo = new PDO("mysql:host=$servername;dbname=$db", $username, $password);
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
}
