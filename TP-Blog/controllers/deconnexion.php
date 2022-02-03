<?php

session_start();

$_SESSION['pseudoAdmin'] = [];

session_destroy();

header('location:admin.php');

?>