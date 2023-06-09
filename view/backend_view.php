
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
        <h1>記事一覧</h1>

        <?php if ($pager['articles']) : ?>
          <table class="table table-bordered">
            <thead>
              <tr>
                <th>ID</th>
                <th>タイトル</th>
                <th>本文</th>
                <th>画像</th>
                <th>カテゴリー</th>
                <th>作成日</th>
                <th>更新日</th>
                <th>編集</th>
                <th>削除</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($pager['articles'] as $article) : ?>
                <tr>
                  <td><?php echo $article->getId() ?></td>
                  <td><?php echo $article->getTitle() ?></td>
                  <td><?php echo $article->getBody() ?></td>
                  <td><?php echo $article->getFilename() ? '<img src="../html/asets/images/album/thumbs-' . $article->getFilename() . '">' : 'なし' ?></td>
                  <td><?php echo isset($categories[$article->getCategoryId()]) ? $categories[$article->getCategoryId()]->getName() : 'なし' ?></td>
                  <td><?php echo $article->getCreatedAt() ?></td>
                  <td><?php echo $article->getUpdatedAt() ?></td>
                  <td><a href="edit.php?id=<?php echo $article->getId() ?>" class="btn btn-success">編集</a></td>
                  <td><a href="delete.php?id=<?php echo $article->getId() ?>" class="btn btn-danger">削除</a></td>
                </tr>
              <?php endforeach ?>
            </tbody>
          </table>
        <?php else : ?>
          <div class="alert alert-info">
            <p>記事はありません。</p>
          </div>
        <?php endif ?>

        <?php if (!empty($pager['total'])) : ?>
          <nav aria-label="Page navigation example">
            <ul class="pagination">
              <?php for ($i = 1; $i <= ceil($pager['total'] / $limit); $i++) : ?>
                <li class="page-item"><a class="page-link" href="backend.php?page=<?php echo $i ?>"><?php echo $i ?></a></li>
              <?php endfor ?>
            </ul>
          </nav>
        <?php endif ?>

      </div>

    </div><!-- /.row -->

  </main><!-- /.container -->

</body>

</html>