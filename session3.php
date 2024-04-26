<?php
session_start();
echo session_id(); //割り振られたKEY
echo $_SESSION["name"];
echo $_SESSION["email"];

?>