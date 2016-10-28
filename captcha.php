<?php
//session_start();
$_SESSION['count']=time(); 
//echo $_SERVER['PHP_SELF']; 
//echo "--1--".$_SERVER['HTTP_REFERER']."--1--";
//echo " http://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI']; 
//echo __DIR__;
//ECHO $_SERVER['SCRIPT_FILENAME'];
//echo $_SERVER['DOCUMENT_ROOT'];
$len_pr = strlen ($_SERVER['DOCUMENT_ROOT']);
$PRIM = substr(__DIR__ , $len_pr);
$ord2 = '/';
$ord1 = '\\';
$PRIM = str_replace (  $ord1, $ord2,$PRIM );
//echo "***".$PRIM;
$len_dir = strlen($PRIM)-strlen(basename(__FILE__));
$dir_s = substr($PRIM,0,$len_dir );
$flag = 5;
 $_POST["vid_sm"]=false;
 $iii=0;
?>
  <!--   <body class="site-content-zajavka">    style="text-align:center;" -->
    <?php
	     /***** определение функций *****/
    function display($pr)
    {
        ?> 
         <div >
            <h3>Введите текст, который видите на картинке</h3>
            <b>Чтобы проверить, что вы не робот</b>
             <div id="div_capt" >

                   <img src="<?php echo "..".$pr."/image".$_SESSION['count']; ?>.png"  /> 
			 </div>

         </div>
 
    <?php
    };
 
    function  create_image()
    {
        $image = imagecreatetruecolor(250, 100);
		$background_color = imagecolorallocate($image, 255, 255, 255);
        imagefilledrectangle($image,0,0,250,100,$background_color);
		$line_color = imagecolorallocate($image, 0, 0, 0);
		$gr = imagecolorallocate($image, 169, 169, 169);
		$gr2 = imagecolorallocate($image, 255, 255, 255);
        for($i=0;$i<10;$i++) {
			 //imageline($image,rand()%250,rand()%100,rand()%100,rand()%250,$line_color);imagesetthickness($image, 20);
		     imagefilledellipse ($image, rand()%50, rand()%100, rand()%100,rand()%150 , $line_color);
			 imagefilledellipse ($image, rand()%50, rand()%100, rand()%50,rand()%100 , $gr2);
             imagefilledarc ( $image ,rand()%100 , rand()%150 ,  rand()%200 ,  rand()%250, rand()%20 , rand()%70 , $gr , IMG_ARC_PIE ); imagesetthickness($image, 5);
			imagefilledarc ( $image ,rand()%50 , rand()%50 , rand()%50 , rand()%50 , rand()%20 , rand()%70 , $gr2 ,IMG_ARC_NOFILL);
			imagepolygon($image, array(rand()%50 ,rand()%50 ,rand()%50 , rand()%50 , rand()%50 ,rand()%50  ), 3, $gr2);
                             };
	    $pixel_color = imagecolorallocate($image, 128, 0, 0);
        for($i=0;$i<1000;$i++) { 
          imagesetpixel($image,rand()%250,rand()%100,$pixel_color);
                               };
	    $letters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890';
        $len = strlen($letters);
        $text_color = imagecolorallocate($image,128,0,0);
		putenv('GDFONTPATH=' . realpath('.'));
		$font =  __DIR__ .'\arial.ttf';
		$grey = imagecolorallocate($image, 192, 192, 192);
		for ($i = 0; $i< 6;$i++) {
             $letter = $letters[rand(0, $len-1)];
            // imagestring($image, 5,  5+($i*30), 20, $letter, $text_color);
             imagettftext($image, 40, rand(-20,$i*10), 15+($i*40), 60, $grey, $font,html_entity_decode($letter));
             $word.=$letter;
                                 };
        $_SESSION['captcha_string'] = $word;
		$_POST["cpt_on"]= $_SESSION['captcha_string'];
		$dir_png=__DIR__ ."\image";
	    $images = glob($dir_png."*.png");
        foreach($images as $image_to_delete) {
                     unlink($image_to_delete); 
					                         };
		imagepng($image, $dir_png.$_SESSION['count'].".png");
		return $_SESSION['captcha_string'];
    };
// ******


?>
<form action = "<? echo "http://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];?>" method="POST"  />

<? 
	if (!isset($_POST["submitP"])) {	
                                    $kod_on = create_image();
                                    display($PRIM);
	                                //echo "==YYYYYYY!==".$_SESSION['captcha_string'];
									$_POST["kod_on"] = $kod_on; 
									echo "<input type=\"hidden\" name=\"kod_on\" value=\"".$_SESSION['captcha_string']."\" /> ";
									?>
									
									<input type="text" name="input" required />
				                   
                                    <input type="submit" value="Проверить код" name="submitP" /> <br>
                                    <a href="<?php echo "http://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];  ?>">Обновить картинку?</a><br>
									<?
                                   }
    else { //echo "POST kod=".$_POST["kod_on"].";";
	    if ($_POST["kod_on"]==$_POST["input"]) 
		                                     {$_POST["input_id"]=1; //echo "inp=".$_POST["input_id"].";"; 
										       //echo " <script> $(\"#div_none_block\").style.visibility = \"block\"; </script>"; 	
                                              
										      } 
		else {
			  $_POST["input_id"]=null;
			  $_POST["submitP"]=null;
			  unset($_POST["submitP"]);
			  
			  ?>
              <div> <h3>Вы ввели некорректный код! Попробуйте обновить страницу!"</h3> </div>			  
			  <h4><a href="<?php echo "http://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];  ?>">Обновить картинку?</a><br></h4> <?
			   
		};
	      
	};				  
//-------
            
?>
</form>


<?php

?>