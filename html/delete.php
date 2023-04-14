<?php
  include '../model/classes/secure.php';
  include '../model/classes/connect.php';
  include '../model/classes/queryArticle.php';
  include '../model/classes/article.php';

  if (!empty($_GET['id'])){
    $queryArticle = new QueryArticle();
    $article = $queryArticle->find($_GET['id']);
    if ($article){
      $article->delete();
    }
  }
  header('Location: backend.php');
