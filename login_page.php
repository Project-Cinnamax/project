<?php
@include 'config.php';

if (isset($_POST['submit'])) {


    # Common For All 
    $email = mysqli_real_escape_string($conn1, $_POST['email']);
    $pass = md5($_POST['password']);

    # IF USER ALREADY EXIST ?
    $select = " SELECT * FROM all_user WHERE email = '$email' && password = '$pass'";
    $result = mysqli_query($conn1, $select);

    if (mysqli_num_rows($result) > 0) {

        $row = mysqli_fetch_array($result);

        if ($row['user_type'] == 'Seller') {
            session_start();
            session_unset();
            session_destroy();
            session_start();
            $_SESSION['name_type'] = $row['user_type'];
            header('location:Home.php');

        } elseif ($row['user_type'] == 'Customer') {
            session_start();
            session_unset();
            session_destroy();
            session_start();
            $_SESSION['name_type'] = $row['user_type'];
            header('location:Home.php');
        } elseif ($row['user_type'] == 'IndustryExpert') {
            $select_Expert = " SELECT * FROM Expert WHERE email = '$email' ";
            $result_Expert = mysqli_query($conn1, $select_Expert);

            if (mysqli_num_rows($result_Expert) > 0) {

                $row = mysqli_fetch_array($result_Expert);
                session_start();
                session_unset();
                session_destroy();
                session_start();
                $_SESSION['name_type'] = $row['user_type'];
                
                if ($row['Status'] == 'Approved') {
                    header('location:approved_expert.php');
                } elseif ($row['Status'] == 'Pending') {
                    header('location:pending_expert.html');
                }
            }
        }

    } else {
        $error[] = 'incorrect email or password!';
    }
    ;

}
;
?>


<!DOCTYPE html>
<html lang="en">
<li><a href="Home.php">Go Back</a></li>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <link rel="Stylesheet" href="loginStyle.css" />
</head>

<body>
    <div class="form-container">

        <form action="" method="post">
            <h3>Login Now</h3>

            <?php
            if (isset($error)) {
                foreach ($error as $error) {
                    echo '<span class="error-msg">' . $error . '</span>';
                }
                ;
            }
            ;
            ?>

            <input type="email" name="email" required placeholder="Your Email Here">
            <input type="password" name="password" required placeholder="Enter your password">

            <input type="submit" name="submit" value="Login" class="form-btn">
            <p>Don't have an account ? <a href="register_form.php">Register Here</a></p>
        </form>
    </div>
</body>

</html>