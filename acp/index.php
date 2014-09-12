<?php
session_start();

if($_SESSION['id'] == session_id() && $_SESSION['acp'] == 'yes') {
header("Location: acp.php?sid=".$_SESSION['id']);
}

require('../config.inc.php');
require(INCLUDES.'login.inc.php');

include(TEMPLATES.'header.htm');

echo('<div id="emptyspace" style="height:150px;"></div>
<div id="loginbox">
<div id="heading">Arctic Fox CMS - ACP</div>
<br />
<br />
<div id="login">'.FORM.'</div>
</div>');

include(TEMPLATES.'footer.htm');
?>