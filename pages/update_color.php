<?php
require_once realpath(__DIR__ . '/../config.php');
require_once realpath(__DIR__ . '/../connection.php');

if(isset($_POST['update_color'])){
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
    } else { 
        header("Location: {$URL_colors}?message=Missing ID");
        exit();
    }
    $name = $_POST['name'];
    $con = new Connection();

    $result = $con->updateColor($id, $name);
    if($result){
        header("Location: {$URL_colors}?message=Color updated successfully");
        exit();
    } else {
        header("Location: {$URL_colors}?message=Unable to update color");
        exit();
    }
} else {
    echo "Invalid request method<br>"; 
    header("Location: {$URL_colors}?message=Invalid request method");
    exit();
}
?>