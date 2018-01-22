<?php 
//フォームのデータ受け取り
$title = $_POST["title"];
$detail = $_POST["detail"];

//DB定義
const DB = "";
const DB_ID = "";
const DB_PW = "";
const DB_NAME = "";

//PDOでデータベース接続
//ザンンプの人はrootいらない
try {
    $pdo = new PDO('mysql:host=localhost;dbname=gsblog_db;charset=utf8','root','');
}catch (PDOException $e) {
    exit('DbConnectError:' . $e->getMessage());
}

// 実行したいSQL文
$sql ="INSERT INTO gsblog_table (id,title,datail,time) VALUES (NULL,:title,:datail,sysdate())";

//MySQLで実行したいSQLセット。プリペアーステートメントで後から値は入れる
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':title',$title,PDO::PARAM_STR);
$stmt->bindValue(':datail',$detail,PDO::PARAM_STR);

//実際に実行
$flag = $stmt->execute();



//実行完了した場合はentry.phpにリダイレクト
//失敗した場合はエラーメッセージ表示
if($flag==false){
    $error = $stmt->errorInfo();
    exit("ErrorQuery:".$error[2]);
}else{
    header('Location:index.php');
    exit();
}
?>