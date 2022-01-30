<?php

require_once("funcs.php");
// functon で共通化する


/**
 * 1. index.phpのフォームの部分がおかしいので、ここを書き換えて、
 * insert.phpにPOSTでデータが飛ぶようにしてください。
 * 2. insert.phpで値を受け取ってください。
 * 3. 受け取ったデータをバインド変数に与えてください。
 * 4. index.phpフォームに書き込み、送信を行ってみて、実際にPhpMyAdminを確認してみてください！
 */

//1. POSTデータ取得
$uniqued = $_POST['uniqued'];
$name = $_POST['name'];
$urls = $_POST['urls'];
$comment = $_POST['comment'];
//2. DB接続します
// try {
//     //ID:'root', Password: 'root'
//     $pdo = new PDO('mysql:dbname=gs_db;charset=utf8;host=localhost', 'root', 'root');
// } catch (PDOException $e) {
//     exit('DBConnectError:' . $e->getMessage());
// }

$pdo = db_conn();

//３．データ登録SQL作成
// 1. SQL文を用意
$stmt = $pdo->prepare("INSERT INTO gs_bm_table_v1(id, uniqued, name, urls, comment, , date)
                        VALUES(NULL,:uniqued :name, :urls, :comment, sysdate())");
//  2. バインド変数を用意
$stmt->bindValue(':uniqued', $uniqued, PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':name', $name, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':urls', $urls, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':comment', $comment, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
//  3. 実行
$status = $stmt->execute();

//４．データ登録処理後
if($status==false){
  //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
  $error = $stmt->errorInfo();
  exit("ErrorMessage:".$error[2]);
}else{
  //５．index.phpへリダイレクト
  header("Location: index.php");

}


?>
