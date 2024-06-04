<?php
//エラー表示
ini_set("display_errors", 1);

//1. POSTデータ取得
$name = $_POST["name"];
$url = $_POST["url"];
$memo = $_POST["memo"];


//2. DB接続します
try {
  //Password:MAMP='root',XAMPP=''
  $pdo = new PDO('mysql:dbname=bm_db;charset=utf8;host=localhost','root','');
} catch (PDOException $e) {
  exit('****************:'.$e->getMessage());
}


//３．データ登録SQL作成
$sql = "INSERT INTO bm_table(name,url,memo,date)VALUES(:name,:url,:memo,sysdate())";
$stmt = $pdo->prepare("$sql");
$stmt->bindValue(':name', $name, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':url', $url, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue('memo', $memo, PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
$status = $stmt->execute();

//４．データ登録処理後
if($status==false){
  //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
  $error = $stmt->errorInfo();
  exit("***********:".$error[2]);
}else{
  //５．index.phpへリダイレクト
  header("Location: index.php");
  exit();


}
?>
