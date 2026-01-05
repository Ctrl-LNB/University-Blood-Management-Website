<?php
session_start();
unset($_SESSION['USER']);
session_regenerate_id(true);

$_SESSION['LOGOUT_SUCCESS'] = true;

header("Location: user.php");
exit;

?>
