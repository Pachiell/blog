<?php
  include '../lib/connect.php';

  // エラーメッセージ
  $err = null;

  if (isset($_POST['name']) && isset($_POST['password'])){
    $db = new connect();

    // 実行したいSQL
    $select = "SELECT * FROM users WHERE name=:name";
    // 第2引数でどのパラメータにどの変数を割り当てるか決める
    $stmt = $db->query($select, array(':name' => $_POST['name']));
    //$select = "SELECT * FROM users WHERE name=$_POST['name']";

    // レコード1件を連想配列として取得する
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($result && password_verify($_POST['password'], $result['password'])){
      // 結果が存在し、パスワードも正しい場合
      session_start();
      $_SESSION['id'] = $result['id'];
      header('Location: backend.php');
    } else {
      $err = "ログインできませんでした。";
    }
  }

 include_once "../view/login_view.php";