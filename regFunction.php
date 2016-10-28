<?
// update records
   function update_rec($email,$password){
	   include('config.php');
       mysql_connect($dbhost, $dbuser, $dbpasswd) or die("Couldn't establish connection");
       mysql_select_db($dbname);
       //echo "email='".$email."' ; password='".$password."' <br>";
       $new_Pass=md5(strip_tags(addslashes(trim($password))));
	   
       if (isset($email))   {
		  $q_select= "select* from list where email='".$email."'";
		  $result = mysql_query($q_select);
		  if (mysql_num_rows($result)>0) {
	            $query = "UPDATE list SET  hpassword = '".$new_Pass."'  WHERE email='".$email."'";
                mysql_query($query) or die("Ошибка запроса обновления!");
                echo "Изменение пароля прошло успешно!";
		                                   }
		  else {echo "Такого пользователя нет! <br> Вам необходимо зарегистрироваться!";};
               };
		return $email;
   };
?>