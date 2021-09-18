<?php
    session_start();
    if(!isset($_SESSION['username']))
    {
        header('Location: ./');
        exit;
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <link rel="stylesheet" href="main.css">
        <title>Home</title>
    </head>
    <body>
        <div class="main">
            <?php
                include "sidebar.php";
                include "feed.php";
                include "left.php";
            ?>
        </div>
    </body>
</html>