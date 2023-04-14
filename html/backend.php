<!-- ここから追加する -->

<?php
include '../model/classes/secure.php';
include '../model/classes/connect.php';
include '../model/classes/queryArticle.php';
include '../model/classes/article.php';
include '../model/classes/queryCategory.php';

$limit = 10;
$page = 1;

// ページ数の決定
if (!empty($_GET['page']) && intval($_GET['page']) > 0) {
  $page = intval($_GET['page']);
}

$queryArticle = new QueryArticle();
$pager = $queryArticle->getPager($page, $limit);

$queryCategory = new QueryCategory();
$categories = $queryCategory->findAll();

include_once "../view/backend_view.php";