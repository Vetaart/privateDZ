<HTML>
<HEAD>
<TITLE>Добро пожаловать!</TITLE>
<meta http-equiv='Content-Type' content="text/html; charset=utf-8">
<link rel="stylesheet" type="text/css" href="style.css">
</HEAD>
<BODY>
<?
$submit1=strip_tags(addslashes(trim($_POST["enter"])));
$submit2=strip_tags(addslashes(trim($_POST["regnew"])));
if ($submit1) { 
include('config.php');
$link = mysql_connect($dbhost, $dbuser, $dbpasswd) or die("Couldn't establish connection");
mysql_select_db($dbname);
//get results
$idemail=strip_tags(addslashes(trim($_POST["id"])));
$password = md5(strip_tags(addslashes(trim($_POST["hpassword"])))); //
$strSelect="SELECT nickname  FROM list where email='".$idemail."'and hpassword like '".$password."'";
$result = mysql_query($strSelect, $link);
$num_rows = mysql_num_rows($result);
if ($num_rows==0) {
	echo "<p id=\"blink\" >Вход не выполнен! <br> Вы ввели неправильный пароль!</p> <br>";
	$_POST["email"]=$idemail;
	include("regnew.php");
	
               }
else { 
$strnick= mysql_result($result,0);
echo "Hello, $strnick ! <br>";
};
?>
<a href="index.php">Перейти на главную страницу</a><br>
<?
}
elseif  ($submit2) {
	include('regnew.htm');
};

?>
</BODY>
</HTML>
