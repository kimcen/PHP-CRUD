<?php
require_once realpath(__DIR__ . '/../connection.php');

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (isset($_GET['id'])) {
        $id = $_GET['id'];

        $con = new Connection();

        $result = $con->deleteColor($id);
        if($result){
            header('Location: ../colors.php?message=Color deleted successfully');
            exit();
        } else {
            header('Location: ../colors.php?message=Unable to delete color');
            exit();
        }
    
    } else {
        echo "Invalid request method<br>"; 
        header('Location: ../colors.php?message=Invalid request method');
        exit();
    }
}
?>
