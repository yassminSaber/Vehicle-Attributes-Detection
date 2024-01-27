<?php
	session_start();
    include('include/connections.php');
	session_unset();
    session_destroy();
    header("Location: Home.php");
    exit;
?>
