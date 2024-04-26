<?php

//0. SESSION開始！！
session_start();

//１．関数群の読み込み
include("funcs.php");

//LOGINチェック → funcs.phpへ関数化しましょう！
sschk();

//２．データ登録SQL作成
$pdo = db_conn();
$sql = "SELECT * FROM test1";
$stmt = $pdo->prepare($sql);
$status = $stmt->execute();

//３．データ表示
$values = "";
if($status==false) {
  sql_error($stmt);
}

//全データ取得
$values =  $stmt->fetchAll(PDO::FETCH_ASSOC); //PDO::FETCH_ASSOC[カラム名のみで取得できるモード]
$json = json_encode($values,JSON_UNESCAPED_UNICODE);

?>



<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>結果表示</title>
<link rel="stylesheet" href="stylesheet.css"> <!-- Changed stylesheet link -->
<link href="css/bootstrap.min.css" rel="stylesheet">
<style>
div{padding: 10px;font-size:16px;}
td{border: 1px solid red;}
</style>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/chart.min.js"></script>

</head>
<body id="main">
<!-- Head[Start] -->
<header>
  <nav class="navbar navbar-default">
    <div class="container-fluid">
      <div class="navbar-header">
        <?=$_SESSION["name"]?>さん、こんにちは！
      <a class="navbar-brand" href="index.php">データ登録</a>
      <a class="navbar-brand" href="logout.php">ログアウト</a>
      </div>
    </div>
  </nav>
</header>
<!-- Head[End] -->


<!-- Main[Start] -->
<div>
    <div class="container jumbotron">
      <table>
      <?php foreach($values as $value){ ?>
        <tr>
        <td><?=h($value["id"])?></td>
        <td><?=h($value["temperature"])?>℃</td> <!-- Display temperature -->
        <td><?=h($value["nausea_level"])?></td> <!-- Display nausea level -->
        <td><?=h($value["fatigue_level"])?></td> <!-- Display fatigue level -->
        <td><?=h($value["pain_level"])?></td> <!-- Display pain level -->
        <td><?=h($value["appetite_level"])?></td> <!-- Display appetite level -->
        <td><?=h($value["numbness_level"])?></td> <!-- Display numbness level -->
        <td><?=h($value["memo"])?></td> <!-- Display memo -->
        <td><?=h($value["indate"])?></td> <!-- Display indate -->
        <td><a href="detail.php?id=<?=$value["id"]?>">[更新]</a></td>
        <td><a href="delete.php?id=<?=$value["id"]?>">[削除]</a></td>
      </tr>
      <?php } ?>
      </table>
    </div>
</div>
<!-- Main[End] -->

<!-- Graph[Start] -->
<div>
  <canvas id="temperatureChart"></canvas>
</div>
<!-- Graph[End] -->

<script>
// PHPから温度データを取得
var temperatures = <?= $json ?>.map(function(item) {
  return item.temperature;
});

// PHPから日付データを取得
var dates = <?= $json ?>.map(function(item) {
  return item.indate;
});

// Chart.jsを使用してグラフを描画
var ctx = document.getElementById('temperatureChart').getContext('2d');
var temperatureChart = new Chart(ctx, {
  type: 'line',
  data: {
    labels:dates, //Array.from(Array(temperatures.length).keys()), // データ数に応じたインデックス配列を生成
    datasets: [{
      label: 'Temperature',
      data: temperatures,
      backgroundColor: 'rgba(255, 99, 132, 0.2)', // 背景色
      borderColor: 'rgba(255, 99, 132, 1)', // 枠線の色
      borderWidth: 1
    }]
  },
  options: {
    scales: {
        y: {
        beginAtZero: false, // y軸を0から始めない設定
        min: 35.0, // y軸の最小値
        max: 40.0 // y軸の最大値
      }
    }
  }
});
</script>

<div style="display: flex; justify-content: space-between;">
<!-- Graph[Start] -->
<div style="width: 200px; height: 200px;"> 吐き気
<canvas id="nauseaLevelPieChart" width="200" height="200"></canvas> 
</div>
<!-- Graph[End] -->

<script>
// PHPからnausea_levelデータを取得
var nauseaLevels = <?= $json ?>.map(function(item) {
  return item.nausea_level;
});

// 各レベルの割合を計算
var levelCounts = {};
nauseaLevels.forEach(function(level) {
  levelCounts[level] = (levelCounts[level] || 0) + 1;
});

// Chart.jsを使用して円グラフを描画
var ctx = document.getElementById('nauseaLevelPieChart').getContext('2d');
var nauseaLevelPieChart = new Chart(ctx, {
  type: 'pie',
  data: {
    labels: Object.keys(levelCounts).map(function(level) { return 'Level ' + level; }), // 各レベルのラベル
    datasets: [{
      label: 'Nausea Level',
      data: Object.values(levelCounts),
      backgroundColor: ['rgba(255, 99, 132, 0.2)', 'rgba(54, 162, 235, 0.2)', 'rgba(255, 206, 86, 0.2)', 'rgba(75, 192, 192, 0.2)', 'rgba(153, 102, 255, 0.2)'],
      borderColor: ['rgba(255, 99, 132, 1)', 'rgba(54, 162, 235, 1)', 'rgba(255, 206, 86, 1)', 'rgba(75, 192, 192, 1)', 'rgba(153, 102, 255, 1)'],
      borderWidth: 1
    }]
  },
  options: {}
});
</script>

<!-- Graph[Start] -->
<div style="width: 200px; height: 200px;">倦怠感
  <canvas id="fatigueLevelPieChart" width="200" height="200"></canvas> <!-- 幅と高さを200pxに設定 -->
</div>
<!-- Graph[End] -->

<script>
// PHPからfatigue_levelデータを取得
var fatigueLevels = <?= $json ?>.map(function(item) {
  return item.fatigue_level;
});

// 各レベルの割合を計算
var levelCounts = {};
fatigueLevels.forEach(function(level) {
  levelCounts[level] = (levelCounts[level] || 0) + 1;
});

// Chart.jsを使用して円グラフを描画
var ctx = document.getElementById('fatigueLevelPieChart').getContext('2d');
var fatigueLevelPieChart = new Chart(ctx, {
  type: 'pie',
  data: {
    labels: Object.keys(levelCounts).map(function(level) { return 'Level ' + level; }), // 各レベルのラベル
    datasets: [{
      label: 'Fatigue Level',
      data: Object.values(levelCounts),
      backgroundColor: ['rgba(255, 99, 132, 0.2)', 'rgba(54, 162, 235, 0.2)', 'rgba(255, 206, 86, 0.2)', 'rgba(75, 192, 192, 0.2)', 'rgba(153, 102, 255, 0.2)'],
      borderColor: ['rgba(255, 99, 132, 1)', 'rgba(54, 162, 235, 1)', 'rgba(255, 206, 86, 1)', 'rgba(75, 192, 192, 1)', 'rgba(153, 102, 255, 1)'],
      borderWidth: 1
    }]
  },
  options: {}
});
</script>

<!-- Graph[Start] -->
<div style="width: 200px; height: 200px;">痛み
  <canvas id="painLevelPieChart" width="200" height="200"></canvas> <!-- 幅と高さを200pxに設定 -->
</div>
<!-- Graph[End] -->

<script>
// PHPからfatigue_levelデータを取得
var painLevels = <?= $json ?>.map(function(item) {
  return item.pain_level;
});

// 各レベルの割合を計算
var levelCounts = {};
painLevels.forEach(function(level) {
  levelCounts[level] = (levelCounts[level] || 0) + 1;
});

// Chart.jsを使用して円グラフを描画
var ctx = document.getElementById('painLevelPieChart').getContext('2d');
var painLevelPieChart = new Chart(ctx, {
  type: 'pie',
  data: {
    labels: Object.keys(levelCounts).map(function(level) { return 'Level ' + level; }), // 各レベルのラベル
    datasets: [{
      label: 'Pain Level',
      data: Object.values(levelCounts),
      backgroundColor: ['rgba(255, 99, 132, 0.2)', 'rgba(54, 162, 235, 0.2)', 'rgba(255, 206, 86, 0.2)', 'rgba(75, 192, 192, 0.2)', 'rgba(153, 102, 255, 0.2)'],
      borderColor: ['rgba(255, 99, 132, 1)', 'rgba(54, 162, 235, 1)', 'rgba(255, 206, 86, 1)', 'rgba(75, 192, 192, 1)', 'rgba(153, 102, 255, 1)'],
      borderWidth: 1
    }]
  },
  options: {}
});
</script>


<!-- Graph[Start] -->
<div style="width: 200px; height: 200px;">食欲
  <canvas id="appetiteLevelPieChart" width="200" height="200"></canvas> <!-- 幅と高さを200pxに設定 -->
</div>
<!-- Graph[End] -->

<script>
// PHPからfatigue_levelデータを取得
var appetiteLevels = <?= $json ?>.map(function(item) {
  return item.appetite_level;
});

// 各レベルの割合を計算
var levelCounts = {};
appetiteLevels.forEach(function(level) {
  levelCounts[level] = (levelCounts[level] || 0) + 1;
});

// Chart.jsを使用して円グラフを描画
var ctx = document.getElementById('appetiteLevelPieChart').getContext('2d');
var appetiteLevelPieChart = new Chart(ctx, {
  type: 'pie',
  data: {
    labels: Object.keys(levelCounts).map(function(level) { return 'Level ' + level; }), // 各レベルのラベル
    datasets: [{
      label: 'Appetite Level',
      data: Object.values(levelCounts),
      backgroundColor: ['rgba(255, 99, 132, 0.2)', 'rgba(54, 162, 235, 0.2)', 'rgba(255, 206, 86, 0.2)', 'rgba(75, 192, 192, 0.2)', 'rgba(153, 102, 255, 0.2)'],
      borderColor: ['rgba(255, 99, 132, 1)', 'rgba(54, 162, 235, 1)', 'rgba(255, 206, 86, 1)', 'rgba(75, 192, 192, 1)', 'rgba(153, 102, 255, 1)'],
      borderWidth: 1
    }]
  },
  options: {}
});
</script>

<!-- Graph[Start] -->
<div style="width: 200px; height: 200px;">しびれ
  <canvas id="numbnessLevelPieChart" width="200" height="200"></canvas> <!-- 幅と高さを200pxに設定 -->
</div>
<!-- Graph[End] -->
<script>
// PHPからfatigue_levelデータを取得
var numbnessLevels = <?= $json ?>.map(function(item) {
  return item.numbness_level;
});

// 各レベルの割合を計算
var levelCounts = {};
numbnessLevels.forEach(function(level) {
  levelCounts[level] = (levelCounts[level] || 0) + 1;
});

// Chart.jsを使用して円グラフを描画
var ctx = document.getElementById('numbnessLevelPieChart').getContext('2d');
var numbnessLevelPieChart = new Chart(ctx, {
  type: 'pie',
  data: {
    labels: Object.keys(levelCounts).map(function(level) { return 'Level ' + level; }), // 各レベルのラベル
    datasets: [{
      label: 'Numbness Level',
      data: Object.values(levelCounts),
      backgroundColor: ['rgba(255, 99, 132, 0.2)', 'rgba(54, 162, 235, 0.2)', 'rgba(255, 206, 86, 0.2)', 'rgba(75, 192, 192, 0.2)', 'rgba(153, 102, 255, 0.2)'],
      borderColor: ['rgba(255, 99, 132, 1)', 'rgba(54, 162, 235, 1)', 'rgba(255, 206, 86, 1)', 'rgba(75, 192, 192, 1)', 'rgba(153, 102, 255, 1)'],
      borderWidth: 1
    }]
  },
  options: {}
});
</script>
</div>



</body>
</html>
