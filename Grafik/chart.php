<?php
 /*include('config.php');
 $link = mysql_connect($dbhost, $dbuser, $dbpasswd) or die("Couldn't establish connection");*/
$querys= $_POST['querys'];
$sel= $_POST['sel'];

 class Chart {
	
	public  $arrW;
	public  $arrW2;
	public  $arrW3;
	public  $arrJob;
	public  $arrSh;
	
	public  function sel() { 
	
	mysql_select_db("firma",mysql_connect("localhost", "root", "")) or die (mysql_error());
    $r = mysql_query("SELECT id,fio,data_start,name_d,name_j FROM worker t1 INNER JOIN department t2 ON t1.key_dep=t2.key_dep INNER JOIN job t3 ON t1.key_job=t3.key_job ORDER BY t2.key_dep,t3.key_job,fio");
    
	while($row = mysql_fetch_row($r))
        { $arrW[]=array("fio"=>$row[1],"data_s"=>$row[2],"dep"=>$row[3],"job"=>$row[4]);
	
	    };
		
		  
	      echo json_encode($arrW);

	} 
	// формирование графика
	public  function formGr($s) { 
	
	mysql_select_db("firma",mysql_connect("localhost", "root", "")) or die (mysql_error());
	$rj = mysql_query("SELECT key_job,name_j FROM job ORDER BY key_job");
	while($rowJ= mysql_fetch_row($rj))
        { 
	     $arrJob[]=array("jobn"=>$rowJ[1],"jobk"=>$rowJ[0]); 
	    };
	$r1 = mysql_query("SELECT key_dep,name_d FROM department ORDER BY key_dep");
    while($row1 = mysql_fetch_row($r1))
	{ 
	
	$depID=$row1[0];
	
    $r2 = mysql_query("SELECT id,fio,data_start,count_day,perk,complementary,balance_current,balance_new,key_job FROM worker WHERE key_dep=$depID ORDER BY key_job");
    $i1 = 0;
	$jobN = "";
	$k = 0;
	$k1 = 0;
	$randMD = 0;
	$dataNY = new DateTime();
	$dNY = new DateTime();
	$arr2job = array();
	$kOld = 0;
	while($row2 = mysql_fetch_row($r2))
        { 
	     foreach($arrJob as $key=>$value){
                 if ($value['jobk']==$row2[8]) {$jobN = $value['jobn']; break;};};
		 
		  $arrW2[]=array("id"=>$row2[0],"fio"=>$row2[1],"dat"=>date('d.m',strtotime($row2[2])).".".$s,"c_day"=>$row2[3],"perk"=>$row2[4],"compl"=>$row2[5],"bal_c"=>$row2[6],"bal_n"=>$row2[7],"dep"=>$row1[1],"job"=>$jobN);
		  $randMD = rand(0,1)*31;
		  $dNY = new DateTime($arrW2[$k]['dat']);
		  
		  if ($dNY>new DateTime('25.11.'.$s)) { $randMD =  $randMD * (-1); $mytext .= "> , =".$randMD; }
		  $dataNY = date_add($dNY, date_interval_create_from_date_string($randMD.' days'));
		  $arrW2[$k]['dat'] = $dataNY;
		   if ($kOld == $row2[8]) {
			  $k1 = $k - 1;
			  if (($arrW2[$k1]['dat']<=$arrW2[$k]['dat'])&&($arrW2[$k]['dat']<date_add($arrW2[$k1]['dat'], date_interval_create_from_date_string($arrW2[$k1]['c_day'].' days'))))
			     { $arrW2[$k1]['dat'] = date_add($arrW2[$k1]['dat'], date_interval_create_from_date_string($arrW2[$k]['c_day'].' days'));}
			  else if (($arrW2[$k]['dat']<=$arrW2[$k1]['dat'])&&($arrW2[$k1]['dat']<date_add($arrW2[$k]['dat'], date_interval_create_from_date_string($arrW2[$k]['c_day'].' days'))))
			     { $arrW2[$k]['dat'] = date_add($arrW2[$k]['dat'], date_interval_create_from_date_string($arrW2[$k1]['c_day'].' days'));};			
		  }; 
		  $k++;
		  $kOld = $row2[8];	    	
	    };
		
		//
		$data_dat=array();
        foreach($arrW2 as $key=>$arr){
               $data_dat[$key]=$arr['dat'];
               }
 
        $data_bn=array();
        foreach($arrW2 as $key=>$arr){
               $data_bn[$key]=$arr['bal_c'];
               }
        
		$data_p=array();
        foreach($arrW2 as $key=>$arr){
               $data_p[$key]=$arr['perk'];
               }
			   
        array_multisort($data_p, SORT_NUMERIC, $data_dat, $data_bn, SORT_NUMERIC, SORT_DESC,  $arrW2);
        var_export($arrW2,true);
		

		for($i = 0; $i < count($arrW2); $i++) 
        {        
		$arrW2[$i]['dat'] = $arrW2[$i]['dat']->format('d.m.Y');
		$arrW3[]=$arrW2[$i];
		};
		unset($arrW2);
	};
			
		echo json_encode($arrW3);
	} 
	
}
 $obj = new Chart();

if ($querys=="read")
{ 
echo $obj->sel();
}
else 
{

echo $obj->formGr($sel);
};

?>

