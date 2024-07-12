<?php
require_once realpath(__DIR__ . '/../config.php');
require_once realpath(__DIR__ . '/../connection.php');

if (isset($_POST['add_color'])) {
    $c_name = $_POST['c_name'];

    $con = new Connection();
    
}
    if (empty($c_name)) {
        header("location:{$URL_colors}?message=You need to fill in the color name");
        exit();
    }
    else{
        $con->insertColor($c_name);
        header("location:{$URL_colors}?message=Color added successfully");
        exit();
    }
?>