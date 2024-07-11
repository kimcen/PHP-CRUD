<?php
require_once realpath(__DIR__ . '/../connection.php');

if(isset($_POST['update_user'])){
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
    } else { 
        header('Location: ../users.php?message=Missing ID');
        exit();
    }
    $name = $_POST['name'];
    $email = $_POST['email'];
    $color_ids = $_POST['color_ids'];

    $con = new Connection();

    $result = $con->updateUser($id, $name, $email, $color_ids);
    if($result){
        header('Location: ../users.php?message=Users updated successfully');
        exit();
    } else {
        header('Location: ../users.php?message=Unable to update users');
        exit();
    }
} else {
    echo "Invalid request method<br>"; 
    header('Location: ../users.php?message=Invalid request method');
    exit();
}
?>