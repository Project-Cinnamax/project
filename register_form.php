<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Form</title>
    <link rel="Stylesheet" href="loginStyle.css" />
</head>

<body>
<?php
    
    @include 'config.php';
    if (isset($_POST['submit'])) {
        

        # Common For All 
        $name = mysqli_real_escape_string($conn1, $_POST['name']);
        $email = mysqli_real_escape_string($conn1, $_POST['email']);
        $pass = md5($_POST['password']);
        $cpass = md5($_POST['cpassword']);
        $user_type = $_POST['user_type'];
        
        # Only Seller
        if ( $_POST['user_type'] =="Seller") {
            $address = mysqli_real_escape_string($conn1, $_POST['address']);
            $telephone = mysqli_real_escape_string($conn1, $_POST['telephone']);    
        }
        
        # Only Industry 
        if ( $_POST['user_type'] =="IndustryExpert") {
            $aaddress = mysqli_real_escape_string($conn1, $_POST['address']);
            $ttelephone = mysqli_real_escape_string($conn1, $_POST['telephone']);    
            $qualifications = mysqli_real_escape_string($conn1, $_POST['qualifications']);
        }
    
        # IF USER ALREADY EXIST ?
        $select = "SELECT * FROM all_user WHERE email = '$email' && password = '$pass' ";
        

        $result = mysqli_query($conn1, $select);

        if (mysqli_num_rows($result) > 0) {
            $error[] = 'User already exist';
        } else {
            if ($pass != $cpass) {
                $error[] = 'Password Not Matched';
            } else {

                if ($user_type == 'Customer') {
                    if (addNewAll($conn1,$email, $pass, $user_type )) {
                        $error[] = 'You have successfully registerd as Customer / Buyer !!!';
                        $insert = "INSERT INTO user_form(name, email, password, user_type) VALUES('$name', '$email', '$pass',  '$user_type')";
                        mysqli_query($conn1, $insert);
                        sleep(1);
                        header('location:login_page.php');
                    }else{
                        $error[] = 'user ready exit';
                    }
                } 
                
                else if ($user_type == 'Seller') {
                    if (addNewAll($conn1,$email, $pass, $user_type )) {
                        $error[] = 'You have successfully registerd as Seller !!!';
                        $insert = "INSERT INTO seller_form(name, email, password, user_type,address,telephone) VALUES('$name', '$email', '$pass',  '$user_type', '$address', '$telephone' )";
                        mysqli_query($conn1, $insert);
                        sleep(1);
                        header('location:login_page.php');
                    }else{
                        $error[] = 'user ready exit';
                    }
                } 
                
                else if ($user_type == 'IndustryExpert') {
                    if (addNewAll($conn1,$email, $pass, $user_type)) {
                        $error[] = 'You have successfully registerd as Industry Expert !!!';
                        $insert = "INSERT INTO expert(name, email, password, user_type,address,telephone,qualifications) VALUES('$name', '$email', '$pass',  '$user_type', '$aaddress', '$ttelephone', '$qualifications')";
                        mysqli_query($conn1, $insert);
                        sleep(1);
                        header('location:login_page.php');
                    }else{
                        $error[] = 'user ready exit';
                    }
                }
                mysqli_close($conn1);
            }
        }
    }
    
    function addNewAll($conn1,$email, $pass, $type){
        try {
            $insertAll = "INSERT INTO `all_user` (`id`, `email`, `password`, `user_type`) VALUES (NULL, '$email', '$pass', '$type')";
            mysqli_query($conn1, $insertAll);
            echo '<script>console.log("saasas");</script>';
            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }
    
    
    
    ?>

    <div class="form-container">

        <form action="" method="post">
            <h3>Register Now</h3>

            <?php
            if (isset($error)) {
                foreach ($error as $error) {
                    echo '<span class = "error-msg">' . $error . '</span>';
                }
            }
            ?>

         
            <script>
                displaySellerInputField = (idele) => {
                    gettingElement = (document.getElementById(idele));

                    if (gettingElement.value == 'Customer') {
                        OnlycustomerInput.setAttribute('style', "trasission: 0.5em;display:block;");
                        OnlysellerInput.setAttribute('style', "trasission: 0.5em;display:none;");
                        IndustryExpert.setAttribute('style', "trasission: 0.5em;display:none;");
                    }

                    else if (gettingElement.value == 'Seller') {
                        OnlysellerInput.setAttribute('style', "trasission: 0.5em;display:block;");
                        IndustryExpert.setAttribute('style', "trasission: 0.5em;display:none;");
                        OnlycustomerInput.setAttribute('style', "trasission: 0.5em;display:none;");
                    }

                    else if (gettingElement.value == 'IndustryExpert') {
                        IndustryExpert.setAttribute('style', "trasission: 0.5em;display:block;");
                        OnlysellerInput.setAttribute('style', "trasission: 0.5em;display:none;");
                        OnlycustomerInput.setAttribute('style', "trasission: 0.5em;display:none;");
                    }

                    else {
                        OnlysellerInput.setAttribute('style', "trasission: 0.5em;display:none;");
                        IndustryExpert.setAttribute('style', "trasission: 0.5em;display:none;");
                        OnlycustomerInput.setAttribute('style', "trasission: 0.5em;display:none;");
                    }
                }
            </script>
            
            <select name="user_type" onchange="displaySellerInputField('selectionId')" id="selectionId">
                <option value="Customer">Customer</option>
                <option value="Seller">Seller</option>
                <option value="IndustryExpert">Industry Expert</option>
            </select>
            <input type="text" name="name" required placeholder="Enter your name">
            <input type="email" name="email" required placeholder="Enter your Email">
            <input type="password" name="password" required placeholder="Enter your password">
            <input type="password" name="cpassword" required placeholder="Re-Enter your password">
            
             <!--Only Customer Registratiojn-->
             <div style="display:none; trasission:5.0s" id="OnlycustomerInput">
                <div>
                    <p>Hello Customer, <br> welcome to the Customer registration protal. please make sure to enter your
                        correct informations.</p>
                </div>
            </div>


            <!--Only seller Registratiojn-->
            <div style="display:none; trasission:5.0s" id="OnlysellerInput">
                 <div>
                    <p>Hello Seller, <br> welcome to the Seller registration protal. please make sure to enter your
                        correct informations.</p>
                </div>
                 <input type="text" name="address"  placeholder="Enter your address">
                <input type="text" name="telephone"  placeholder="Enter your telephone">
            </div>
               <!--Only Industry Expert Registratiojn-->
            
            
               <div style="display:none; trasission:5.0s" id="IndustryExpert">
            
            <div>
               <p>Hello Expert, <br> welcome to the Expert registration protal. please make sure to enter your
                   correct informations.</p>
           </div>
      
           

           <div>
           
                    <input type="text" name="address"  placeholder="Enter your address">
                    <input type="text" name="telephone"  placeholder="Enter your telephone">
                    <input type="file" name="qualifications"  placeholder="Drop your Qualifications here">
                    <p>To maintain the quality of service. We will verify your documents within one business day.</p>
                    <p>Your Expert login password will be diliverd as a mail to your private mail address.</p>
           </div>
       </div>
       
       
           
           
            
            
            
            
           




         

            <input type="submit" name="submit" value="register now" class="form-btn">
            <p>Already have an account ? <a href="login_page.php">Login Here</a></p>
        </form>
    </div>
 
</body>


</html>