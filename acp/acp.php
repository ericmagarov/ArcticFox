<?php
session_start();
session_id($_GET['sid']);

require('../config.inc.php');

if($_SESSION['acp'] != 'yes' || $_SESSION['id'] != $_GET['sid']) {
 include('logout.php');
 exit();
}

$page = $_GET['page'] ? $_GET['page'] : 'index';

mysql_connect(HOST, USER, PWD);
mysql_select_db(DB);

$result = mysql_query('SELECT include, content, includable, content_after_include, content_before_include FROM '.MYSQL_PREFIX.'_acp_content WHERE page="'.$page.'" LIMIT 1') or die(mysql_error());

$navres = mysql_query('SELECT page_title, nav_title FROM '.MYSQL_PREFIX.'_acp_navigation ORDER BY `order`') or die(mysql_error());

mysql_close();

$cache = mysql_fetch_array($result);

if($cache['include'] == 'logout.inc.php') {
 include(INCLUDES.$cache['include']);
}

include(TEMPLATES.'header.htm');

/*if($cache['content'] == null && $cache['inlcude'] == null) {
 echo('404 Page Not Found');
 include(TEMPLATES.'footer.htm');
 exit();
}*/

echo('<ul id="navigation">');
while($navcache = mysql_fetch_array($navres)) {
 echo('<li><a href="'.$_SERVER['PHP_SELF'].'?page='.$navcache['page_title'].'&sid='.$_SESSION['id'].'">'.$navcache['nav_title'].'</a></li>');
}
echo('</ul>');

echo('<div id="navborder"></div>');

echo('<div id="content">');
if($cache['includable'] == 1) {
 echo $cache['content_before_include'];
 include(INCLUDES.$cache['include']);
 echo $cache['content_after_include'];
} else {
 echo $cache['content'];
}
echo('</div>');

include(TEMPLATES.'footer.htm');
?>