<?php 
session_start();
session_unset();
$$_FILES = [];
session_destroy();

header("Location: login.php");
	exit;

?>