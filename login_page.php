<?php
    @include 'config.php';
    
    session_start();
    if (isset($_POST['submit'])) {
        

        # Common For All 
        $name = mysqli_real_escape_string($conn, $_POST['name']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $pass = md5($_POST['password']);
        $cpass = md5($_POST['cpassword']);
        $user_type = $_POST['user_type'];
        $address = mysqli_real_escape_string($conn, $_POST['address']);
        $telephone = mysqli_real_escape_string($conn, $_POST['telephone']);    
        $aaddress = mysqli_real_escape_string($conn, $_POST['address']);
        $ttelephone = mysqli_real_escape_string($conn, $_POST['telephone']);    
        $qualifications = mysqli_real_escape_string($conn, $_POST['qualifications']);
    
        # IF USER ALREADY EXIST ?
        $select = " SELECT * FROM user_form WHERE email = '$email' && password = '$pass'";

        $result = mysqli_query($conn, $select);
     
        if(mysqli_num_rows($result) > 0){
     
           $row = mysqli_fetch_array($result);
     
           if($row['user_type'] == 'Seller'){
     
              $_SESSION['name'] = $row['name'];
              header('location:seller_page.php');
     
           }elseif($row['user_type'] == 'Customer'){
     
              $_SESSION['user_name'] = $row['name'];
              header('location:user_page.php');
     
           }
          
        }else{
           $error[] = 'incorrect email or password!';
        }
     
     };
     ?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <link rel="Stylesheet" href="loginStyle.css" />
</head>
<body>
    <div class ="form-container">
        
        <form action="" method="post">
            <h3>Login Now</h3>
            
            <?php
                if(isset($error)){
                    foreach($error as $error){
                        echo '<span class="error-msg">'.$error.'</span>';
                    };
                };
            ?>
            
            <input type="email" name="email" required placeholder="Your Email Here">
            <input type="password" name="password" required placeholder="Enter your password">
            
            <input type="submit" name="submit" value="Login" class="form-btn">
            <p>Don't have an account ? <a href="register_form.php">Register Here</a></p>
        </form>
    </div>
</body>
</html>