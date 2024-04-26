<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width">
<link rel="stylesheet" href="css/main.css" />
<link href="css/bootstrap.min.css" rel="stylesheet">
<style>div{padding: 10px;font-size:16px;}</style>
<style>
    body {
        background-color: #f8f9fa; 
    }
    header {
        background-color: grey; 
        color: #fff; 
        text-align: center;
        padding: 10px 0;
        margin-bottom: 20px;
    }
    form {
        max-width: 320px; 
        margin: 0 auto;
        background-color: #fff; 
        padding: 20px;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); 
    }
    form input[type="text"],
    form input[type="password"] {
        width: 100%;
        padding: 10px;
        margin: 10px 0;
        border: 1px solid #ccc; 
        border-radius: 3px;
        box-sizing: border-box;
    }
    form input[type="submit"] {
        width: 100%;
        padding: 10px;
        background-color: grey; 
        color: #fff; 
        border: none;
        border-radius: 3px;
        cursor: pointer;
        transition: background-color 0.3s ease; 
    }
    form input[type="submit"]:hover {
        background-color: #0056b3; 
    }

    .new{
        text-align: center;
    }
</style>
<title>ログイン</title>
</head>
<body>

<header>
  <nav class="navbar navbar-default">LOGIN</nav>
</header>

<!-- lLOGINogin_act.php は認証処理用のPHPです。 -->
<form name="form1" action="login_act.php" method="post">
ID:<input type="text" name="lid">
PW:<input type="password" name="lpw">
<input type="submit" value="ログイン">
</form>

<div class=new><a href="./user.php">初めての方はこちら</a></div>

</body>
</html>