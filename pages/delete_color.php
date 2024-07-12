<?php
require_once realpath(__DIR__ . '/../config.php');
require_once realpath(__DIR__ . '/../connection.php');

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (isset($_GET['id'])) {
        $id = $_GET['id'];

        $con = new Connection();

        $result = $con->deleteColor($id);
        if($result){
            header("Location: {$URL_colors}?message=Color deleted successfully");
            exit();
        } else {
            header("Location: {$URL_colors}?message=Unable to delete color");
            exit();
        }
    
    } else {
        echo "Invalid request method<br>"; 
        header("Location: {$URL_colors}?message=Invalid request method");
        exit();
    }
}
?>
