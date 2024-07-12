<?php
require_once realpath(__DIR__ . '/../config.php');
require_once realpath(__DIR__ . '/../connection.php');

if(isset($_POST['update_user'])){
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
    } else { 
        header("Location: {$URL_users}?message=Missing ID");
        exit();
    }
    $name = $_POST['name'];
    $email = $_POST['email'];
    $color_ids = $_POST['color_ids'];

    $con = new Connection();

    $result = $con->updateUser($id, $name, $email, $color_ids);
    if($result){
        header("Location: {$URL_users}?message=User updated successfully");
        exit();
    } else {
        header("Location: {$URL_users}?message=Unable to update users");
        exit();
    }
} else {
    echo "Invalid request method<br>"; 
    header("Location: {$URL_users}?message=Invalid request method");
    exit();
}
?>