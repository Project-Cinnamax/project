<!DOCTYPE html>
<?php
        session_start();
        try {
                   if( $_SESSION['name_type'] !="IndustryExpert"){
                    header('location:login_page.php');
            }
        } catch (\Throwable $th) {
            header('location:login_page.php');
        }
?>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>User | Cinnamon</title>
        <link rel="Stylesheet" href="loginStyle.css" />
    </head>
    <body>
        <div class="container">
            <div class="content">
            <pre>
            <?php
            print_r($_SESSION);
            ?>
            </pre>
                <h3>This is Approved Expert</h3>
                <a href="logout.php">Log out</a>
            </div>
        </div>
    </body>
</html>