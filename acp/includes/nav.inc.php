<?php

$action = $_GET['do'] ? $_GET['do'] : 'show';

echo('<br />');

switch($action) {
 case 'show':
 default:
  mysql_connect(HOST, USER, PWD);
  mysql_select_db(DB);
  $result = mysql_query('SELECT page_title, nav_title FROM '.MYSQL_PREFIX.'_navigation ORDER BY `order`') or die(mysql_error());
  mysql_close();
  echo('<ul style="list-style-type:none;">');
  while($cache = mysql_fetch_array($result)) {
   if($cache['page_title'] != 'acp' && $cache['page_title'] != 'index') {
    echo('<li><a href="'.$_SERVER['PHP_SELF'].'?sid='.$_SESSION['id'].'&page=nav&do=edit&content='.$cache['page_title'].'">'.$cache['nav_title'].'</a> <a href="'.$_SERVER['PHP_SELF'].'?sid='.$_SESSION['id'].'&page=nav&do=delete&content='.$cache['page_title'].'"><img src="'.IMAGES.'delete.png" style="border:none;" /></a></li>');
   } else {
    echo('<li>'.$cache['nav_title'].'</li>');
   }
  }
  $cache = array();
  echo('</ul>');
  echo('<br />');
  include(INCLUDES.'newnav.inc.php');
  break;
 case 'edit':
  mysql_connect(HOST, USER, PWD);
  mysql_select_db(DB);
  $result = mysql_query('SELECT page_title, nav_title FROM '.MYSQL_PREFIX.'_navigation WHERE page_title="'.$_GET['content'].'" LIMIT 1') or die(mysql_error());
  mysql_close();
  $cache = mysql_fetch_array($result);
  include(INCLUDES.'editnav.inc.php');
  break;
 case 'savenew':
  mysql_connect(HOST, USER, PWD);
  mysql_select_db(DB);
  $result = mysql_query('SELECT MAX(`order`) AS `maxorder` FROM '.MYSQL_PREFIX.'_navigation WHERE NOT (page_title = "acp")') or die(mysql_error());
  $cache = mysql_fetch_array($result);
  mysql_query('INSERT INTO '.MYSQL_PREFIX.'_navigation (`page_title`, `nav_title`, `order`) VALUES ("site'.($cache['maxorder'] + 1).'", "'.$_POST['navigation'].'", '.($cache['maxorder'] + 1).')') or die(mysql_error());
  mysql_query('INSERT INTO '.MYSQL_PREFIX.'_content (`page`, `time`, `created_by`, `access_rights`) VALUES ("site'.($cache['maxorder'] + 1).'", '.time().', "Arctic Fox CMS", 0)') or die(mysql_error());
  mysql_close();
  echo('Neue Seite erfolgreich gespeichert! <br /> Klicken Sie <a href="'.$_SERVER['PHP_SELF'].'?sid='.$_SESSION['id'].'&page=nav">hier</a>, um zum Editieren zurückzukehren.');
  break;
 case 'save':
  mysql_connect(HOST, USER, PWD);
  mysql_select_db(DB);
  mysql_query('UPDATE '.MYSQL_PREFIX.'_navigation SET nav_title="'.$_POST['navigation'].'" WHERE page_title="'.$_GET['content'].'"') or die(mysql_error());
  mysql_close();
  echo('Navigation erfolgreich editiert! <br /> Klicken Sie <a href="'.$_SERVER['PHP_SELF'].'?sid='.$_SESSION['id'].'&page=nav">hier</a>, um zum Editieren zurückzukehren.');
  break;
 case 'delete':
  mysql_connect(HOST, USER, PWD);
  mysql_select_db(DB);
  mysql_query('DELETE FROM '.MYSQL_PREFIX.'_navigation WHERE page_title="'.$_GET['content'].'" LIMIT 1') or die(mysql_error());
  mysql_query('DELETE FROM '.MYSQL_PREFIX.'_content WHERE page="'.$_GET['content'].'" LIMIT 1') or die(mysql_error());
  mysql_close();
  echo('Seite erfolgreich gelöscht! <br /> Klicken Sie <a href="'.$_SERVER['PHP_SELF'].'?sid='.$_SESSION['id'].'&page=nav">hier</a>, um zum Editieren zurückzukehren.');
  break;
}

?>