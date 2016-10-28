<html>
<head>
<meta http-equiv='Content-Type' content="text/html; charset=utf-8">
<title>Добавление записи</title>
<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<?
include('config.php');
mysql_connect($dbhost, $dbuser, $dbpasswd) or die("Couldn't establish connection");
mysql_select_db($dbname);
//Insert Values
$email = strip_tags(addslashes(trim($_POST["email"])));
$password = md5(strip_tags(addslashes(trim($_POST["parol"])))); //hpassword
$nickname = strip_tags(addslashes(trim($_POST["nickname"])));
//echo "nickname after='".$nickname."'";
$query1="select * from list where email like '".$email."'";
//and hpassword like '".$password."'";
$result=mysql_query($query1);
if (mysql_num_rows($result)>0) {
	echo "Такой пользователь уже зарегистрирован!";
	
}
else  {
    	if ($nickname == "") {
			 echo "Вам необходимо зарегистрироваться! ";
		}
		else { 
             $query = "INSERT into list (email, hpassword, nickname) Values('$email', '$password', '$nickname')";
             mysql_query($query) or die("Ошибка запроса!");
             echo "Регистрация прошла успешно!";
		};
};
?>
<br>
<br>
<?
//<a href="insert.htm">Добавить контакт</a><br>
?>
<form method="POST" action="enter.php">
 <table border="0" width="47%">
    <tr>    
      <td width="34%">E-mail</td>
      <td width="71%"><? print ($email);?></td>
    </tr>
<?
$password ='';
?>
    <tr>
      <td width="34%">Введите Ваш пароль:</td>
      <td width="71%"><input type="password" id="parolid" name="hpassword" size="36" required ></td>
    </tr>
	
 </table>
<?
// скрытое поле hidden 
echo "   <input type=\"hidden\" name=\"id\" value=\"{$_POST['email']}\">";
?>
<a href="restorepass.php">Забыли пароль?</a><br>
 <p><input type="submit" value="Вход" name="enter"> <input type="submit" value="Регистрация" name="regnew"></p>
</form>
</body>
</html>
