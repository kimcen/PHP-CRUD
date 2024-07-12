<?php
    session_start();
    // Gets url being used for the site
    // function getBaseUrl() {
    //     // Picks between https or http
    //     $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
    //     $domainName = $_SERVER['HTTP_HOST'];                             // Gets current domain name
    //     $scriptPath = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\');    // Adds script name to it
    //     return $protocol . $domainName . $scriptPath . '/';
    // }
    function getBaseUrl() {
        $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
        $domainName = $_SERVER['HTTP_HOST'];
        $rootPath = str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME']));
        return $protocol . $domainName . $rootPath . '/';
    }

    // Define the base URL only once
    if (!isset($_SESSION['base_url'])) {
        $_SESSION['base_url'] = getBaseUrl();
    }

    $URL_index = $_SESSION['base_url'] . 'index.php';
    $URL_connection = $_SESSION['base_url'] . 'connection.php';
    $URL_header = $_SESSION['base_url'] . 'header.php';
    $URL_footer = $_SESSION['base_url'] . 'footer.php';
    $URL_users = $_SESSION['base_url'] . 'users.php';
    $URL_colors = $_SESSION['base_url'] . 'colors.php';
    $URL_style = $_SESSION['base_url'] . 'style.css';
    $URL_update_user_page = $_SESSION['base_url'] . 'pages/update_user_page.php';
    $URL_update_user = $_SESSION['base_url'] . 'pages/update_user.php';
    $URL_update_color_page = $_SESSION['base_url'] . 'pages/update_color_page.php';
    $URL_update_color = $_SESSION['base_url'] . 'pages/update_color.php';
    $URL_delete_user = $_SESSION['base_url'] . 'pages/delete_user.php';
    $URL_delete_color = $_SESSION['base_url'] . 'pages/delete_color.php';
    $URL_insert_user = $_SESSION['base_url'] . 'pages/insert_user.php';
    $URL_insert_color = $_SESSION['base_url'] . 'pages/insert_color.php';
    
    require 'connection.php';

    $connection = new Connection();
?>