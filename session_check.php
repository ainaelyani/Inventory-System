<?php
session_start();

if(!isset($_SESSION['user_id'])){   //if user not log in
    header("Location: /inventory-system");  //kena kick
    exit;
}
?>