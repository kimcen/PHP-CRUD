<?php
require_once '../config.php';
require_once '../connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (isset($_GET['id'])) {
        $id = $_GET['id'];

        $con = new Connection();

        $result = $con->deleteUser($id);
        if($result){
            header("Location: {$URL_users}?message=User deleted successfully");
            exit();
        } else {
            header("Location: {$URL_users}?message=Unable to delete user");
            exit();
        }
    
    } else {
        echo "Invalid request method<br>"; 
        header("Location: {$URL_users}?message=Invalid request method");
        exit();
    }
}
?>
