<?php
session_start();
error_reporting(E_ALL);
var_dump($_SESSION);
if (isset($_SESSION['nurse']['email'])){
    unset($_SESSION['nurse']['email']);
    header('Location: index/');
    exit();
}
/*else{
    header('Location: index/');
    exit();
}*/


