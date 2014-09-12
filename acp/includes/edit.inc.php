<?php

$action = $_GET['do'] ? $_GET['do'] : 'show';

switch($action) {
 case 'show':
  mysql_connect(HOST, USER, PWD);
  mysql_select_db(DB);
  $result = mysql_query('SELECT page_title, nav_title FROM '.MYSQL_PREFIX.'_navigation ORDER BY `order`') or die(mysql_error());
  mysql_close();
  echo('<ul style="list-style-type:none;">');
  while($cache = mysql_fetch_array($result)) {
   if($cache['page_title'] != 'acp') {
    echo('<li><a href="'.$_SERVER['PHP_SELF'].'?sid='.$_SESSION['id'].'&page=pages&do=edit&content='.$cache['page_title'].'">'.$cache['nav_title'].'</a></li>');
   }
  }
  echo('</ul>');
  break;
 case 'edit':
  mysql_connect(HOST, USER, PWD);
  mysql_select_db(DB);
  $result = mysql_query('SELECT content FROM '.MYSQL_PREFIX.'_content WHERE page="'.$_GET['content'].'"') or die(mysql_error());
  mysql_close();
  $cache = mysql_fetch_array($result);
  echo('<form method="post" action="'.$_SERVER['PHP_SELF'].'?sid='.$_SESSION['id'].'&page=pages&do=save&content='.$_GET['content'].'">
	<p>	
		<textarea name="text" style="height:40%;width:80%">'.$cache['content'].'</textarea>
		<input type="submit" value="Speichern" />
	</p>	
	</form>');
  break;
 case 'save':
  mysql_connect(HOST, USER, PWD);
  mysql_select_db(DB);
  mysql_query('UPDATE '.MYSQL_PREFIX.'_content SET content="'.str_replace('\'', '\\\'', $_POST['text']).'", time='.time().' WHERE page="'.$_GET['content'].'"') or die(mysql_error().'<br /> Die Seite konnte nicht gespeichert werden. Bitte versuchen Sie es erneut.');
  mysql_close();
  echo('Die Seite wurde erfolgreich gespeichert. <br /> Klicken Sie <a href="'.$_SERVER['PHP_SELF'].'?sid='.$_SESSION['id'].'&page=pages&do=show">hier</a>, um zur Auswahl zurückzukehren.');
  break;
 default:
  echo('501 Not Implemented');
}

?>