<!DOCTYPE html>
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
            session_start();
            print_r($_SESSION);
            ?>
            </pre>
                <h3>This is Customer Page</h3>
            </div>
        </div>
    </body>
</html>