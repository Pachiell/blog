<!-- ここから追加する -->

<?php
include '../model/classes/secure.php';
include '../model/classes/connect.php';
include '../model/classes/queryArticle.php';
include '../model/classes/article.php';
include '../model/classes/queryCategory.php';

$title = "";        // タイトル
$body = "";         // 本文
$title_alert = "";  // タイトルのエラー文言
$body_alert = "";   // 本文のエラー文言

// カテゴリーの準備
$queryCategory = new QueryCategory();
$categories = $queryCategory->findAll();

if (!empty($_POST['title']) && !empty($_POST['body'])) {
  // titleとbodyがPOSTメソッドで送信されたとき
  $title = $_POST['title'];
  $body = $_POST['body'];
  $article = new Article();
  $article->setTitle($title);
  $article->setBody($body);
  // 省略
  $article->setTitle($title);
  $article->setBody($body);

  if (isset($_FILES['image']) && is_uploaded_file($_FILES['image']['tmp_name'])) {
    $article->setFile($_FILES['image']);
  }

  if (!empty($_POST['category'])) {
    $category = $queryCategory->find($_POST['category']);
    if ($category) {
      $article->setCategoryId($category->getId());
    }
  }

  $article->save();
  header('Location: backend.php');
} else if (!empty($_POST)) {
  // POSTメソッドで送信されたが、titleかbodyが足りないとき
  // 存在するほうは変数へ、ない場合空文字にしてフォームのvalueに設定する
  if (!empty($_POST['title'])) {
    $title = $_POST['title'];
  } else {
    $title_alert = "タイトルを入力してください。";
  }

  if (!empty($_POST['body'])) {
    $body = $_POST['body'];
  } else {
    $body_alert = "本文を入力してください。";
  }
}

include_once "../view/post_view.php";