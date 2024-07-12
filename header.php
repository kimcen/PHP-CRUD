<?php
    require "config.php";

    $users = $connection->query('SELECT u.id AS id, 
                                        u.name AS uname, 
                                        u.email AS email, 
                                        GROUP_CONCAT(c.name) AS color
                                    FROM users u
                                    LEFT JOIN user_colors uc ON u.id = uc.user_id 
                                    LEFT JOIN colors c ON uc.color_id = c.id
                                    GROUP BY u.id
                                    ');
    $colors = $connection->query("SELECT * FROM colors");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create, Read, Update, Delete.</title>
    <!-- Bootstrap code-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href= <?php echo $URL_style ?>>
</head>

<body style="height: 3000px; background-color: #f0eee8">
    <div>
        <div class="header">
            <h1 id="main_title"><a href=<?php echo $URL_index?>>My Database</a></h1>
        </div>
        
        <div class="sidebar">
            <div style="display: block; height: 170px;"></div>
            <div style="display: flex;
                        flex-direction: column;">
                <a class="options" href=<?php echo $URL_users?>>See Users</a>
                <a class="options" href=<?php echo $URL_colors?>>See Colors</a>
            </div>
        </div>