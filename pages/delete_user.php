<?php
require_once realpath(__DIR__ . '/../connection.php');

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (isset($_GET['id'])) {
        $id = $_GET['id'];

        $con = new Connection();

        $result = $con->deleteUser($id);
        if($result){
            header('Location: ../users.php?message=User deleted successfully');
            exit();
        } else {
            header('Location: ../users.php?message=Unable to delete user');
            exit();
        }
    
    } else {
        echo "Invalid request method<br>"; 
        header('Location: ../users.php?message=Invalid request method');
        exit();
    }
}
?>
