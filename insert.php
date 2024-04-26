<?php
// 1. POSTデータ取得

$temperature = $_POST["temperature"]; // 体温
$nausea_level = $_POST["nausea_level"]; // 吐き気レベル
$fatigue_level = $_POST["fatigue_level"]; // 倦怠感レベル
$pain_level = $_POST["pain_level"]; // 痛みレベル
$appetite_level = $_POST["appetite_level"]; // 食欲レベル
$numbness_level = $_POST["numbness_level"]; // しびれレベル
$memo = $_POST["memo"]; // メモ

// 2. DB接続
include("funcs.php");
$pdo = db_conn();

// 3. データ登録SQL作成
$sql = "INSERT INTO test1 (temperature, nausea_level, fatigue_level, pain_level, appetite_level, numbness_level, memo, indate) 
        VALUES (:temperature, :nausea_level, :fatigue_level, :pain_level, :appetite_level, :numbness_level, :memo, sysdate())";
$stmt = $pdo->prepare($sql);

$stmt->bindValue(':temperature', $temperature, PDO::PARAM_STR);
$stmt->bindValue(':nausea_level', $nausea_level, PDO::PARAM_INT);
$stmt->bindValue(':fatigue_level', $fatigue_level, PDO::PARAM_INT);
$stmt->bindValue(':pain_level', $pain_level, PDO::PARAM_INT);
$stmt->bindValue(':appetite_level', $appetite_level, PDO::PARAM_INT);
$stmt->bindValue(':numbness_level', $numbness_level, PDO::PARAM_INT);
$stmt->bindValue(':memo', $memo, PDO::PARAM_STR);
$status = $stmt->execute(); // true or false

// 4. データ登録処理後
if ($status === false) {
    sql_error($stmt);
} else {
    redirect("select.php");
}
?>