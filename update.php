<?php
session_start();

// 1. POSTデータ取得
$id = $_POST["id"];
$temperature = $_POST["temperature"];
$nausea_level = $_POST["nausea_level"];
$fatigue_level = $_POST["fatigue_level"];
$pain_level = $_POST["pain_level"];
$appetite_level = $_POST["appetite_level"];
$numbness_level = $_POST["numbness_level"];
$memo = $_POST["memo"];

// 2. DB接続
include("funcs.php");
sschk();
$pdo = db_conn();

// 3. データ更新SQL作成
$sql = "UPDATE test1 SET temperature=:temperature, nausea_level=:nausea_level, fatigue_level=:fatigue_level, pain_level=:pain_level, appetite_level=:appetite_level, numbness_level=:numbness_level, memo=:memo WHERE id=:id";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':temperature', $temperature, PDO::PARAM_STR);
$stmt->bindValue(':nausea_level', $nausea_level, PDO::PARAM_INT);
$stmt->bindValue(':fatigue_level', $fatigue_level, PDO::PARAM_INT);
$stmt->bindValue(':pain_level', $pain_level, PDO::PARAM_INT);
$stmt->bindValue(':appetite_level', $appetite_level, PDO::PARAM_INT);
$stmt->bindValue(':numbness_level', $numbness_level, PDO::PARAM_INT);
$stmt->bindValue(':memo', $memo, PDO::PARAM_STR);
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$status = $stmt->execute();

// 4. データ更新処理後の処理
if($status==false){
    // 更新が失敗した場合はエラーメッセージを表示して終了する
    $errorInfo = $stmt->errorInfo();
    exit("SQLエラー：" . $errorInfo[2]);
} else {
    // 更新が成功した場合は、リダイレクトする
    header("Location: select.php");
    exit();
}