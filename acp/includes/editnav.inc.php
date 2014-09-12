<form action="<?php echo($_SERVER['PHP_SELF'].'?sid='.$_SESSION['id'].'&page=nav&do=save&content='.$_GET['content']); ?>" method="post">
<input type="text" name="navigation" value="<?php echo $cache['nav_title']; ?>" size="30" />
<br />
<input type="submit" name="submit" value="Speichern" />
</form>