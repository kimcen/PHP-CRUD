<?php
require_once realpath(__DIR__ . '/../config.php');
require_once realpath(__DIR__ . '/../connection.php');

if (isset($_POST['add_user'])) {
    $uname = $_POST['uname'];
    $email = $_POST['email'];
    $color_ids = $_POST['color_ids'];

    $con = new Connection();
    
}
    if (empty($uname) || empty($email) || empty($color_ids)) {
        header("location:{$URL_users}?message=You need to fill in every box");
        exit();
    }
    else{
        $con->insertUser($uname, $email, $color_ids);
        header("location:{$URL_users}?insert_msg=User added successfully");
        exit();
    }
?>