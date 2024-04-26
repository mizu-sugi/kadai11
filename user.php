<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="./stylesheet2.css">
</head>
<body>

    <div class = "main">
        <div class = "form-title">ユーザー登録</div>


        <form action="insert2.php" method="POST">

        <div class = "form-item">お名前</div>
            <input type="text" name="name">
        
        <div class="form-item">ログインID</div>
            <input type="text" name="lid">

        <div class="form-item">パスワード</div>
            <input type="text" name="lpw">


            <div class="form-wrapper">
    <input type="submit" value="送信">
</div>
        </form>


    </div>
</body>
</html>