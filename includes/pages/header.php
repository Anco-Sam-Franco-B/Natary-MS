<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $page_title ?></title>
    <link rel="stylesheet" href="./assets/css/a.css">
    <link rel="stylesheet" href="./assets/plugins/fontawesome-free/css/all.min.css">
</head>
<body>
    <div class="container">
        <div class="header">
            <?php
                $title = mysqli_query($con, 'SELECT * FROM settings');
                $row = mysqli_fetch_array($title);
            ?>
            <h1><?php echo $row['title'] ?></h1> 
            <div class="menu" onclick="toggleMenu()">
                <i class="fas fa-bars"></i>
            </div>
        </div>
        <div class="main">
            <nav>
                <ul>
                    <li><a href="index.php" class='activeLink'><i class="fas fab fa-tachometer-alt icon"></i>DashBoard</a></li>
                    <li><a href="documents.php"><i class="fas fab fa-file-alt icon"></i>Documents</a></li>
                    <li><a href="agreements.php"><i class="fas fa-file-signature icon"></i> Agreements</a></li>
                    <li><a href="settings.php"><i class="fas fab fa-cogs icon"></i> Settings</a></li>
                    <li><a href="logout.php"><i class="fas fa-sign-out-alt icon"></i> Log Out</a></li>
                </ul>
            </nav>
            <div class="contents">