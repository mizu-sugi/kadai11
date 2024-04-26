<?php
// 1. POSTデータ取得

$name = $_POST["name"]; 
$lid = $_POST["lid"]; 
$lpw = $_POST["lpw"]; 

// パスワードをハッシュ化
$hashed_password = password_hash($lpw, PASSWORD_DEFAULT);


// 2. DB接続
include("funcs.php");
$pdo = db_conn();

// 3. データ登録SQL作成
$sql = "INSERT INTO user_table (name, lid, lpw) 
        VALUES (:name, :lid, :lpw)";
$stmt = $pdo->prepare($sql);

$stmt->bindValue(':name', $name, PDO::PARAM_STR);
$stmt->bindValue(':lid', $lid, PDO::PARAM_STR);
$stmt->bindValue(':lpw', $hashed_password, PDO::PARAM_STR); // ハッシュ化されたパスワードを保存
$status = $stmt->execute(); // true or false

// 4. データ登録処理後
if ($status === false) {
    sql_error($stmt);
} else {
    redirect("login.php");
}
?>