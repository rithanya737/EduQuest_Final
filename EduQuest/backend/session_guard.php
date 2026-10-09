<?php
session_start();
if (empty($_SESSION["user_id"])) {
    header("Location: ../home/login.php");
    exit;
}
?>
