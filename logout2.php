<?php 
session_start();

session_destroy();

header('Location: StudentLogin.php');
exit;
?>