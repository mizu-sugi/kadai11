<?php
session_start();
$id = $_GET["id"];
include("funcs.php");
//LOGINチェック funcs.phpへ関数化
sschk();
$pdo = db_conn();

//２．データ登録SQL作成
$sql = "SELECT * FROM test1 WHERE id=:id";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id', $id, PDO::PARAM_INT); //integer（数値の場合）
$status = $stmt->execute();

//３．データ表示
if($status==false) {
   sql_error($stmt);
}

// //全データ取得
$v =  $stmt->fetch(); 
//PDO::FETCH_ASSOC[カラム名のみで取得できるモード]
//$json = json_encode($values,JSON_UNESCAPED_UNICODE);
?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>フリーアンケート更新</title>
  <link rel="stylesheet" type="text/css" href="stylesheet.css">
  <style>div{padding: 10px;font-size:16px;}</style>
</head>
<body>

<!-- Head[Start] -->
<header>
  <nav class="navbar navbar-default">
    <div class="container-fluid">
    <div class="navbar-header"><a class="navbar-brand" href="select.php">データ一覧</a></div>
    </div>
  </nav>
</header>
<!-- Head[End] -->

<!-- Main[Start] -->
<div class = "main">
        <div class = "form-title">今日の体調</div>


        <form action="update.php" method="POST">
            <div class = "form-item">体温</div>
            <input type="text" name="temperature" value="<?=$v["temperature"]?>">℃
        
            <div class="form-item">吐き気</div>
            <input type="radio" name="nausea_level" value="1" <?php if($v["nausea_level"] == "1") echo "checked"; ?>>1（全くなし）
            <input type="radio" name="nausea_level" value="2" <?php if($v["nausea_level"] == "2") echo "checked"; ?>>2（気になる）
            <input type="radio" name="nausea_level" value="3" <?php if($v["nausea_level"] == "3") echo "checked"; ?>>3（我慢できる）
            <input type="radio" name="nausea_level" value="4" <?php if($v["nausea_level"] == "4") echo "checked"; ?>>4（辛い）
            <input type="radio" name="nausea_level" value="5" <?php if($v["nausea_level"] == "5") echo "checked"; ?>>5（とても辛い）

            <div class="form-item">倦怠感</div>
            <input type="radio" name="fatigue_level" value="1" <?php if($v["fatigue_level"] == "1") echo "checked"; ?>>1（全くなし）
            <input type="radio" name="fatigue_level" value="2" <?php if($v["fatigue_level"] == "2") echo "checked"; ?>>2（気になる）
            <input type="radio" name="fatigue_level" value="3" <?php if($v["fatigue_level"] == "3") echo "checked"; ?>>3（我慢できる）
            <input type="radio" name="fatigue_level" value="4" <?php if($v["fatigue_level"] == "4") echo "checked"; ?>>4（辛い）
            <input type="radio" name="fatigue_level" value="5" <?php if($v["fatigue_level"] == "5") echo "checked"; ?>>5（とても辛い）

            <div class="form-item">痛み</div>
            <input type="radio" name="pain_level" value="1" <?php if($v["pain_level"] == "1") echo "checked"; ?>>1（全くなし）
            <input type="radio" name="pain_level" value="2" <?php if($v["pain_level"] == "2") echo "checked"; ?>>2（気になる）
            <input type="radio" name="pain_level" value="3" <?php if($v["pain_level"] == "3") echo "checked"; ?>>3（我慢できる）
            <input type="radio" name="pain_level" value="4" <?php if($v["pain_level"] == "4") echo "checked"; ?>>4（辛い）
            <input type="radio" name="pain_level" value="5" <?php if($v["pain_level"] == "5") echo "checked"; ?>>5（とても辛い）

            <div class="form-item">食欲</div>
            <input type="radio" name="appetite_level" value="1" <?php if($v["appetite_level"] == "1") echo "checked"; ?>>1（あり）
            <input type="radio" name="appetite_level" value="2" <?php if($v["appetite_level"] == "2") echo "checked"; ?>>2（普段通り）
            <input type="radio" name="appetite_level" value="3" <?php if($v["appetite_level"] == "3") echo "checked"; ?>>3（少しなら）
            <input type="radio" name="appetite_level" value="4" <?php if($v["appetite_level"] == "4") echo "checked"; ?>>4（飲み物だけ）
            <input type="radio" name="appetite_level" value="5" <?php if($v["appetite_level"] == "5") echo "checked"; ?>>5（何も飲食できない）

            <div class="form-item">しびれ</div>
            <input type="radio" name="numbness_level" value="1" <?php if($v["numbness_level"] == "1") echo "checked"; ?>>1（全くなし）
            <input type="radio" name="numbness_level" value="2" <?php if($v["numbness_level"] == "2") echo "checked"; ?>>2（気になる）
            <input type="radio" name="numbness_level" value="3" <?php if($v["numbness_level"] == "3") echo "checked"; ?>>3（我慢できる）
            <input type="radio" name="numbness_level" value="4" <?php if($v["numbness_level"] == "4") echo "checked"; ?>>4（辛い）
            <input type="radio" name="numbness_level" value="5" <?php if($v["numbness_level"] == "5") echo "checked"; ?>>5（とても辛い）

            <div class = "form-item">その他、気になる症状</div>
            <textarea name="memo"><?=$v["memo"]?></textarea>
            <input type="hidden" name="id" value="<?=$v["id"]?>">

            <input type="submit" value="送信">
        </form>
    </div>
<!-- Main[End] -->


</body>
</html>