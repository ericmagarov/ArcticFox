<form action="<?php echo($_SERVER['PHP_SELF'].'?sid='.$_SESSION['id'].'&page=nav&do=savenew'); ?>" method="post">
<input type="text" name="navigation" value="Neue Seite" size="30" />
<br />
<input type="submit" name="submit" value="Speichern" />
</form>