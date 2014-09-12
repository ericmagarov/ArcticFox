<?php
session_start();

require('../config.inc.php');

mysql_connect(HOST, USER, PWD);
mysql_select_db(DB);

$userSQL = mysql_query('SELECT password FROM '.MYSQL_PREFIX.'_acp_users WHERE username="'.$_POST['username'].'" LIMIT 1') or die(mysql_error());

if($user = mysql_fetch_array($userSQL)) {

if(md5($_POST['password']) == $user['password']) {
 $_SESSION['id'] = session_id();
 $_SESSION['acp'] = 'yes';
 header('Location: acp.php?sid='.$_SESSION['id']);
} else {
 session_destroy();
 header('Location: '.URL);
}

} else {

session_destroy();
header('Location: '.URL);

}

mysql_close();

?>