<?php include('config.php'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Artisan</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
<section class="navbar">
    <div class="container">
        <div class="logo">
            <a href="<?php echo SITEURL; ?>" title="Logo">
                <img src="images/logo.png" class="img-responsive">
            </a>
        </div>

        <div class="menu text-right">
            <ul>
                <li>
                    <a href="<?php echo SITEURL; ?>">Pagina principala</a>
                </li>
                <li>
                    <a href="<?php echo SITEURL; ?>categoryPage.php">Categori</a>
                </li>
                <li>
                    <a href="<?php echo SITEURL; ?>menuPage.php">Meniu</a>
                </li>
                <li>
                    <a href="<?php echo SITEURL; ?>userPage.php"><img src="<?php echo SITEURL; ?>images/user.png" alt="Sterge produs" class="user-icon"/></a>
                </li>
            </ul>
        </div>

        <div class="clearfix"></div>
    </div>
</section>
