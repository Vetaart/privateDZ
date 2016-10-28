<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Установка пароля</title>
<link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>

<h1> Установка пароля </h1>
<?php
$new_kod=$_POST["new_kod"];
$submit=$_POST["NewRestore"];
if (!isset($submit)) {
?>
<form method="post" action="restore.php">
<h3>Код восстановления   :<input type="text" class="input_class" name="kodRest" required></h3>
<p class="comment"><b><sup>*</sup>Содержится в отправленном Вам письме</b></p>
<h3>Новый пароль         :<input type="password" class="input_class" name="newpassword" required></h3>
<p class="comment"><b><sup>*</sup>Пароль должен содержать 7 и более символов, <br>
используйте буквы и цифры. Необходимо <br>
наличие строчных и заглавных букв <br>
(например: Fzxc987)</b></p>
<h3>Подтверждение пароля :<input type="password" class="input_class" name="newpassword2" required></h3> <br>
<? 
$new_kod=strip_tags(addslashes(trim($_POST["new_kod"])));
$email=strip_tags(addslashes(trim($_POST["email"])));
echo "   <input type=\"hidden\" name=\"new_kod\" value=\"{$new_kod}\">";
echo "   <input type=\"hidden\" name=\"email\" value=\"{$email}\">";
//$_POST["subject"]=$subject;
//$_POST["content"]=$content;
//$_POST["header"]=$header;
?>
<br>
<br>
<input type="submit" name ="NewRestore" value="Установить пароль">
</form>
<?
}
else {
$kodRest=strip_tags(addslashes(trim($_POST["kodRest"])));
$new_kod=strip_tags(addslashes(trim($_POST["new_kod"])));
if ($kodRest==$new_kod) {
include ('regFunction.php');
//echo "POst email='".$_POST["email"]."' ;  <br>";
$email=update_rec($_POST["email"],$_POST["newpassword"]);
//echo "up email='".$email."' ;  <br>";
echo "   <input type=\"hidden\" name=\"email\" value=\"{$email}\">";
                         };
?>
<a href="enterReg.php">Попробовать войти</a><br>
<?
};	
?>
</body>
</html>
