<?php
$title = "Barcha postlar";
require "../includes/header.php";

// DB
require '../func/db.php';
$id = $_GET['id'];

$statement = $pdo->prepare("SELECT * FROM posts WHERE id = ?");
$statement->execute([$id]);

$post = $statement->fetch();

?>

<div class="container">
  <div class="row mt-5">
    <div class="col-8 mx-auto">
      <h1 class="text-center">Postlarni ko'rish</h1>
      <h2>ID: <?= $post['id'] ?> &nbsp;&nbsp; Date: <?= $post['create_at'] ?></h2>
      <h3><?= $post['title'] ?></h3>
      <p><?= $post['body'] ?></p>
    </div>
  </div>
</div>

<?php require "../includes/footer.php" ?>