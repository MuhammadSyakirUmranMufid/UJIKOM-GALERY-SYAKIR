<?php

session_start();
$_SESSION = [];
session_destroy();
header("Location: ../../login/login.php", true);

?>