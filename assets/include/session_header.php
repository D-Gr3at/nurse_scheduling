<?php
session_start();
if (!isset($_SESSION['nurse']['email'])) {
    header('Location: logout.php');
} else {
    include_once('assets/lib/dbcxn.inc.php');
    $database = new DataBase();

    $conn = $database->getInstance();
    $email = $_SESSION['nurse']['email'];
    $sql = "SELECT * FROM nurse_account na INNER JOIN nurse_tracker nt on nt.nurse_id = na.id
                INNER JOIN nurse_details nd on na.id = nd.nurse_id WHERE na.email = '$email'";
//    echo $sql.'\n';
    $sql = $conn->query($sql);
    $loggedInNurse = $sql->fetch_assoc();

}
