<?php
function GetDataArt($art_id){
  $sel = "SELECT `title`,`page_title`,`meta_d`,`meta_kw`,`content` FROM `articles` WHERE `id` = '$art_id' LIMIT 1";
  $query = mysql_query($sel);
  if(!$query){
echo('Не удалось взять данные из БД!');
  }
  else{
if(mysql_num_rows($query)>0){
  $res = mysql_fetch_array($query);
  $title = $res['title']; // заголовок текста
  $page_title = $res['page_title']; // название страницы
  $meta_kw = $res['meta_kw'];
  $meta_d = $res['meta_d'];
  $content = $res['content'];
}
else{
  $title = 'К сожалению, такая страница отсутствует на данном сайте!';
  $page_title = 'К сожалению, такая страница отсутствует на данном сайте!';
  $meta_kw = $meta_d = $content = '';
}
$data_arr = array($title, $page_title, $meta_kw, $meta_d, $content);
return $data_arr;
  }
}
?>