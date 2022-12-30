<?php
$title = "Blog";
require "includes/header.php";
// DB
require './func/db.php';

$statement = $pdo->prepare("SELECT * FROM posts");
$statement->execute();

$posts = $statement->fetchAll();

if ($_SERVER["REQUEST_METHOD"] == 'POST' && isset($_POST["DELETE"])) {

  $id = $_POST['post_id'];

  $stmt = $pdo->prepare("DELETE FROM posts WHERE id = ?");
  $stmt->execute([$id]);

  header('Location: blog.php');
  exit;
}

?>

<section class="py-5 text-center container">

  <?php if (isset($_SESSION["new-post"])) : ?>
    <div class="alert alert-success" role="alert">
      Yangi Post Qo'shildi
      <?php unset($_SESSION["new-post"]) ?>
    </div>
  <?php endif; ?>

  <div class="row py-lg-5">
    <div class="col-lg-6 col-md-8 mx-auto">
      <h1 class="fw-light">Bizni Blog</h1>
      <p class="lead text-muted">Something short and leading about the collection below—its contents, the creator, etc. Make it short and sweet, but not too short so folks don’t simply skip over it entirely.</p>
      <p>
        <a href="models/post_create.php" class="btn btn-primary my-2">POST QO'SHISH</a>
        <a href="/" class="btn btn-secondary my-2">BOSH SAHIFA</a>
      </p>
    </div>
  </div>
</section>

<div class="album py-5 bg-light">
  <div class="container-fuild mx-4">

    <div class="row row-cols-1 row-cols-sm-2 row-cols-lg-4 g-4">

      <?php foreach ($posts as $post) : ?>
        <div class="col">
          <div class="card shadow-sm">
            <svg class="bd-placeholder-img card-img-top" width="100%" height="225" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Thumbnail" preserveAspectRatio="xMidYMid slice" focusable="false">
              <title>Placeholder</title>
              <rect width="100%" height="100%" fill="#55595c" /><text x="50%" y="50%" fill="#eceeef" dy=".3em">Thumbnail</text>
            </svg>
            <div class="card-body">
              <h3><?= $post['title'] ?></h3>
              <p class="card-text"><?= $post['body'] ?></p>
              <small class="text-muted"><b><?= $post['create_at'] ?></b></small>
              <div class="d-flex justify-content-between align-items-center">
                <div class="btn-group">
                  <a href="./models/post_all.php?id=<?= $post['id'] ?>" class="btn btn-sm btn-outline-primary">View</a>
                  <a href="./models/post_edit.php?id=<?= $post['id'] ?>" class="btn btn-sm btn-outline-secondary">Edit</a>
                  <form action="" method="POST" onsubmit="return confirm('POST UCHIRILYAPTI...')">
                    <input type="hidden" name="post_id" value="<?= $post['id'] ?>">
                    <input type="hidden" name="DELETE">
                    <button type="submit" class="btn btn-sm btn-outline-danger ml-5">Delete</button>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      <?php endforeach; ?>

    </div>
  </div>
</div>

<?php require "includes/footer.php" ?>