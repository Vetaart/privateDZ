<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Восстановление пароля</title>
<link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
<h1> </h1>
<?php
$submit=$_POST["submitRestore"];
 function gen_pass()  
  {  
    $arr = array('a','b','c','d','e','f',  
                 'g','h','i','j','k','l',  
                 'm','n','o','p','r','s',  
                 't','u','v','x','y','z',  
                 'A','B','C','D','E','F',  
                 'G','H','I','J','K','L',  
                 'M','N','O','P','R','S',  
                 'T','U','V','X','Y','Z',  
                 '1','2','3','4','5','6',  
                 '7','8','9','0');  
    // Генерируем пароль  
    $pass = "";  
    for($i = 0; $i < 8; $i++)  
    { $index = rand(0, count($arr) - 1);  
      $pass .= $arr[$index];  
    }  
    return $pass;  
  };

if (!isset($submit)) {
?>
<form method="post" action="restorepass.php">
<h2> Введите e-mail, указанный при регистрации. <br>
 Вам будет выслана ссылка для восстановления <br> </h2>
e-mail :<input type="email" name="email" required> <br>
<? 
$subject=" Восстановление пароля ";
$content="regnew.htm";
$sender="admin.proect@mail.ru";
$otvet="all.send@mail.ru";
$header="Content-type: text/html\r\n; charset=\"windows-1251\"";
$header.="From:$sender\r\n"."Reply-To:$otvet\r\n";
$header.="Content-type: text/html; charset=\"windows-1251\"";
echo "   <input type=\"hidden\" name=\"subject\" value=\"{$subject}\">";
echo "   <input type=\"hidden\" name=\"content\" value=\"{$content}\">";
echo "   <input type=\"hidden\" name=\"header\" value=\"{$header}\">";
//$_POST["subject"]=$subject;
//$_POST["content"]=$content;
//$_POST["header"]=$header;
?>
<br>
<br>
<input type="submit" name ="submitRestore" value="Восстановить">
</form>
<?
}
else {
?>
<form method="post" action="restore.php">
<? 	
$email=$_POST["email"];
$subject=$_POST["subject"];
$content=$_POST["content"];
$header=$_POST["header"];
$new_kod=gen_pass(); 
$content.="\r\n Ваш код восстановления: ".$new_kod." ";
//echo "1=".$email."=2=".$subject."=3=".$content."=4=".$header."<br> 555";
mail($email,$subject,$content,$header);
echo "<h4>Запрос восстановления пароля отправлен на почту ".$email."<br>";
echo "\r\n Следуйте инструкции...</h4>"; 
echo "   <input type=\"hidden\" name=\"email\" value=\"{$_POST['email']}\">";
echo "   <input type=\"hidden\" name=\"new_kod\" value=\"{$new_kod}\">";
?>
<br>
<br>
<input type="submit" name ="Restore" value="Продолжить">
</form>
<?
}
?>

</body>
</html>
