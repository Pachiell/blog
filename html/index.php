<?php
include '../model/classes/connect.php';
include '../model/classes/queryArticle.php';
include '../model/classes/article.php';
include '../model/classes/queryCategory.php';

$queryArticle = new QueryArticle();
$queryCategory = new QueryCategory();

// メニューの準備
$monthly = $queryArticle->getMonthlyArchiveMenu();
$category = $queryCategory->getCategoryMenu();

$limit = 5;
$page = 1;

$month = null;
$title = "";
$category_id = null;

// ページ数の決定
if (!empty($_GET['page']) && intval($_GET['page']) > 0) {
  $page = intval($_GET['page']);
}

// 月指定
if (!empty($_GET['month'])) {
  $month = $_GET['month'];
  $title = $month . 'の投稿一覧';
}

  // カテゴリー別
  if (isset($_GET['category'])){
    if (isset($category[$_GET['category']])){
      $title = 'カテゴリー：'.$category[$_GET['category']]['name'];
      $category_id = intval($_GET['category']);
    } else {
      $title = 'カテゴリーなし';
      $category_id = 0;
    }   
  }

$pager = $queryArticle->getPager($page, $limit, $month, $category_id);

include_once "../view/index_view.php";