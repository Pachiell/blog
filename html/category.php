<?php
include('../model/classes/secure.php');
include('../model/classes/connect.php');
include('../model/classes/queryCategory.php');

$queryCategory = new QueryCategory();
$formCategory = null; // 編集するカテゴリ情報

if (!empty($_POST['action']) && $_POST['action'] == 'add' && !empty($_POST['name'])) {
    $category = new Category();
    $category->setName($_POST['name']);
    $category->save();
} else if (!empty($_GET['action']) && $_GET['action'] == 'edit' && !empty($_GET['id'])) {
    // 編集モードのとき
    $formCategory = $queryCategory->find($_GET['id']);
} else if (!empty($_POST['action']) && $_POST['action'] == 'edit' && !empty($_POST['id']) && !empty($_POST['name'])) {
    // 編集
    $category = $queryCategory->find($_POST['id']);
    if ($category) {
        $category->setName($_POST['name']);
        $category->save();
    }
} else if (!empty($_GET['action']) && $_GET['action'] == 'delete' && !empty($_GET['id'])) {
    // 削除モードのとき
    $category = $queryCategory->find($_GET['id']);
    if ($category) {
        $category->delete();
    }
}


// 登録されているカテゴリーをすべて取得
$categories = $queryCategory->findAll();

 include_once "../view/category_view.php";