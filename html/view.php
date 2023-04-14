<?php
include '../model/classes/connect.php';
include '../model/classes/queryArticle.php';
include '../model/classes/article.php';
include '../model/classes/queryCategory.php';

$queryArticle = new QueryArticle();
$queryCategory = new QueryCategory();

if (!empty($_GET['id'])) {
  $id = intval($_GET['id']);
  $article = $queryArticle->find($id);
} else {
  $article = null;
}
$monthly = $queryArticle->getMonthlyArchiveMenu();
$category = $queryCategory->getCategoryMenu();

include_once "../view/view_view.php";