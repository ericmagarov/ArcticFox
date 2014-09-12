<?php
require('config.inc.php');

$page = $_GET['page'] ? $_GET['page'] : 'index';

mysql_connect(HOST, USER, PWD);
mysql_select_db(DB);

$result_content = mysql_query('SELECT content, page FROM '.MYSQL_PREFIX.'_content WHERE page="'.$page.'" LIMIT 1') or die(mysql_error());

$result_navigation = mysql_query('SELECT nav_title, page_title FROM '.MYSQL_PREFIX.'_navigation ORDER BY `order`') or die(mysql_error());

mysql_close();

$content = mysql_fetch_array($result_content);

if($content['page'] == 'acp') {
 header('Location: '.URL.'acp');
}

include(TEMPLATES.'header.htm');


echo('<ul id="navigation" style="list-style-type:none;">');
while($row = mysql_fetch_array($result_navigation)) {
 echo('<li><a href="'.$_SERVER['PHP_SELF'].'?page='.$row['page_title'].'">'.$row['nav_title'].'</a></li>');
}
echo('</ul>');

echo('<div id="navborder"></div>');

echo('<div id="content">'.str_replace('\\\'', '\'', $content['content']).'</div>');

include(TEMPLATES.'footer.htm');

?>