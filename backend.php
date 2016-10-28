<?php
 $meth= $_POST['meth'];
$yearP=$_POST['year'];
$monthP=$_POST['month'];
$dayP=$_POST['day'];
 class Backend {
	public static $VAL = 0;	
	public static $mess = 'Назначен день года ';
	
	public static function sync() { 
    	self::$VAL = time()*1000;
		
		$dataServ=date("j.m.Y G:i:s");
	    echo json_encode(array("time"=>self::$VAL));
	 
     } 
	public static function calc($year, $month, $day) { 
	// {"message":"Назначен день года $VAL"}, где $VAL — номер дня в году, от 1 до 366 (включительно)
	
		  $new_d = mktime(0,0,0,$month, $day,$year);
		  self::$mess.=  date("z",$new_d) + 1;
	      echo json_encode(array("message"=>self::$mess));
	
     }
}

if ($meth=="sync") { echo Backend::sync();}
elseif ($meth=="calc") { echo Backend::calc($yearP, $monthP, $dayP);}


?>

