<!-- ここから追加する -->

<?php
include '../model/classes/secure.php';
include '../model/classes/connect.php';
include '../model/classes/queryArticle.php';
include '../model/classes/article.php';
include '../model/classes/queryCategory.php';

$title = "";        // タイトル
$body = "";         // 本文
$id = "";           // ID
$category_id = "";  // カテゴリーID
$title_alert = "";  // タイトルのエラー文言
$body_alert = "";   // 本文のエラー文言

// カテゴリーの準備
$queryCategory = new QueryCategory();
$categories = $queryCategory->findAll();

if (isset($_GET['id'])) {
  $queryArticle = new QueryArticle();
  $article = $queryArticle->find($_GET['id']);

  if ($article) {
    // 編集する記事データが存在したとき、フォームに埋め込む
    $id = $article->getId();
    $title = $article->getTitle();
    $body = $article->getBody();
    $category_id = $article->getCategoryId();
  } else {
    // 編集する記事データが存在しないとき
    header('Location: backend.php');
    exit;
  }
} else if (!empty($_POST['id']) && !empty($_POST['title']) && !empty($_POST['body'])) {
  // id, titleとbodyがPOSTメソッドで送信されたとき
  $title = $_POST['title'];
  $body = $_POST['body'];

  $queryArticle = new QueryArticle();
  $article = $queryArticle->find($_POST['id']);
  if ($article) {
    // 記事データが存在していれば、タイトルと本文を変更して上書き保存
    $article->setTitle($title);
    $article->setBody($body);
    // 画像がアップロードされていたとき
    if (isset($_FILES['image']) && is_uploaded_file($_FILES['image']['tmp_name'])) {
      $article->setFile($_FILES['image']);
    }
    if (!empty($_POST['category'])) {
      $category = $queryCategory->find($_POST['category']);
      if ($category) {
        $article->setCategoryId($category->getId());
      }
    } else {
      $article->setCategoryId(null);
    }
    $article->save();
  }
  header('Location: backend.php');
  exit;
} else if (!empty($_POST)) {
  // POSTメソッドで送信されたが、titleかbodyが足りないとき
  if (!empty($_POST['id'])) {
    $id = $_POST['id'];
  } else {
    // 編集する記事IDがセットされていなければ、backend.phpへ戻る
    header('Location: backend.php');
    exit;
  }

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
 include_once "../view/edit_view.php";