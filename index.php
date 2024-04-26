<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="stylesheet.css">
</head>
<body>

    <div class = "main">
        <div class = "form-title">今日の体調</div>


        <form action="insert.php" method="POST">

        <div class = "form-item">体温</div>
            <input type="text" name="temperature">℃
        
        <div class="form-item">吐き気</div>
        <input type="radio" name="nausea_level" value="1">1（全くなし）
        <input type="radio" name="nausea_level" value="2">2（気になる）
        <input type="radio" name="nausea_level" value="3">3（我慢できる）
        <input type="radio" name="nausea_level" value="4">4（辛い）
        <input type="radio" name="nausea_level" value="5">5（とても辛い）

        <div class="form-item">倦怠感</div>
        <input type="radio" name="fatigue_level" value="1">1（全くなし）
        <input type="radio" name="fatigue_level" value="2">2（気になる）
        <input type="radio" name="fatigue_level" value="3">3（我慢できる）
        <input type="radio" name="fatigue_level" value="4">4（辛い）
        <input type="radio" name="fatigue_level" value="5">5（とても辛い）

        <div class="form-item">痛み</div>
        <input type="radio" name="pain_level" value="1">1（全くなし）
        <input type="radio" name="pain_level" value="2">2（気になる）
        <input type="radio" name="pain_level" value="3">3（我慢できる）
        <input type="radio" name="pain_level" value="4">4（辛い）
        <input type="radio" name="pain_level" value="5">5（とても辛い）

        <div class="form-item">食欲</div>
        <input type="radio" name="appetite_level" value="1">1（あり）
        <input type="radio" name="appetite_level" value="2">2（普段通り）
        <input type="radio" name="appetite_level" value="3">3（少しなら）
        <input type="radio" name="appetite_level" value="4">4（飲み物だけ）
        <input type="radio" name="appetite_level" value="5">5（何も飲食できない）

        <div class="form-item">しびれ</div>
        <input type="radio" name="numbness_level" value="1">1（全くなし）
        <input type="radio" name="numbness_level" value="2">2（気になる）
        <input type="radio" name="numbness_level" value="3">3（我慢できる）
        <input type="radio" name="numbness_level" value="4">4（辛い）
        <input type="radio" name="numbness_level" value="5">5（とても辛い）


 

            <div class = "form-item">その他、気になる症状</div>
            <textarea name="memo"></textarea>

            <div class="form-wrapper">
    <input type="submit" value="送信">
</div>
        </form>


    </div>
</body>
</html>