<?php 
session_start();

session_destroy();

header('Location: OfficialsLogin.php');
exit;
?>