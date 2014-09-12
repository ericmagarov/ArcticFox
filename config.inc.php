<?php
//Setup dependent variables
define(HOST, 'localhost');
define(USER, 'DATENBANKBENUTZER');
define(PWD, 'DATENBANKPASSWORT');
define(DB, 'DATENBANK');
define(URL, 'HTTP-URL ZUM CMS');
define(SERVERURL, 'ABSOLUTER SERVERPFAD ZUM CMS');
//Wenn nichts an den Datenbanken verändert wurde, einfach stehen lassen
define(MYSQL_PREFIX, 'dev');

//Constant directories
define(TEMPLATES, 'tpl/');
define(INCLUDES, 'includes/');
define(ACP, 'acp/');
define(PHP, 'phpinfo/');
define(STYLE, 'style/');
define(IMAGES, 'images/');

//Constant ACP-only directories
define(TINY, 'tiny/');

//Necessary including of important files
require('functions.inc.php');
?>