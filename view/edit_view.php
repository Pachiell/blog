
<!doctype html>
<html lang="ja">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Blog Backend</title>

  <!-- Bootstrap core CSS -->
  <link href="../html/asets/css/bootstrap.min.css" rel="stylesheet">

  <style>
    body {
      padding-top: 5rem;
    }

    .bd-placeholder-img {
      font-size: 1.125rem;
      text-anchor: middle;
      -webkit-user-select: none;
      -moz-user-select: none;
      user-select: none;
    }

    @media (min-width: 768px) {
      .bd-placeholder-img-lg {
        font-size: 3.5rem;
      }
    }

    .bg-red {
      background-color: #ff6666 !important;
    }
  </style>

  <!-- Custom styles for this template -->
  <link href="../html/asets/css/blog.css" rel="stylesheet">
</head>

<body>

  <nav class="navbar navbar-expand-md navbar-dark bg-red fixed-top">
    <div class="container">
      <a class="navbar-brand" href="/blog/backend.php">My Blog Backend</a>
      <div class="collapse navbar-collapse" id="navbarCollapse">
        <ul class="navbar-nav me-auto mb-2 mb-md-0">
          <li class="nav-item"><a class="nav-link" href="#">記事を書く</a></li>
          <li class="nav-item"><a class="nav-link" href="logout.php">ログアウト</a></li>
        </ul>
      </div>
    </div>
  </nav>
  <?php include('../view/templates/nav.php'); ?>

  <main class="container">
    <div class="row">
      <div class="col-md-12">

        <h1>記事の編集</h1>

        <form action="edit.php" method="post" enctype="multipart/form-data">
          <input type="hidden" name="id" value="<?php echo $id ?>">
          <div class="mb-3">
            <label class="form-label">タイトル</label>
            <?php echo !empty($title_alert) ? '<div class="alert alert-danger">' . $title_alert . '</div>' : '' ?>
            <input type="text" name="title" value="<?php echo $title; ?>" class="form-control">
          </div>
          <div class="mb-3">
            <label class="form-label">本文</label>
            <?php echo !empty($body_alert) ? '<div class="alert alert-danger">' . $body_alert . '</div>' : '' ?>
            <textarea name="body" class="form-control" rows="10"><?php echo $body; ?></textarea>
          </div>
          <div class="mb-3">
          <label class="form-label">カテゴリー</label>
          <select name="category" class="form-control">
            <option value="0">なし</option>
            <?php foreach ($categories as $c): ?>
            <option value="<?php echo $c->getId() ?>" <?php echo $category_id == $c->getId()? 'selected="selected"': '' ?>><?php echo $c->getName() ?></option>
            <?php endforeach ?>
          </select>
        </div>
          <?php if ($article->getFilename()) : ?>
            <div class="mb-3">
              <img src="../html/asets/images/album/thumbs-<?php echo $article->getFilename() ?>">
            </div>
          <?php endif ?>

          <div class="mb-3">
            <label class="form-label">画像</label>
            <input type="file" name="image" class="form-control">
          </div>
          <div class="mb-3">
            <button type="submit" class="btn btn-primary">投稿する</button>
          </div>
        </form>
      </div>

    </div><!-- /.row -->

  </main><!-- /.container -->

</body>

</html>