<?php
require_once realpath(__DIR__ . '/../connection.php');

if(isset($_POST['update_color'])){
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
    } else { 
        header('Location: ../colors.php?message=Missing ID');
        exit();
    }
    $name = $_POST['name'];
    $con = new Connection();

    $result = $con->updateColor($id, $name);
    if($result){
        header('Location: ../colors.php?message=Color updated successfully');
        exit();
    } else {
        header('Location: ../colors.php?message=Unable to update color');
        exit();
    }
} else {
    echo "Invalid request method<br>"; 
    header('Location: ../colors.php?message=Invalid request method');
    exit();
}
?>