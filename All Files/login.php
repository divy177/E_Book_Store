<?php
    include 'config.php';

    if(isset($_REQUEST["submit"])){
      $email = $_REQUEST["personal_mail"];
      $passw = $_REQUEST["pass_id"];
    
      $ins = "INSERT into logindetails(Email_ID,Password) VALUES ('$email', '$passw')";
      $query = mysqli_query($connection , $ins);
    //   echo "<script>alert('Successfully Logged In');</script>";
      echo "<meta http-equiv='refresh' content='0;url=homepage.html'>";
      if (!$query){
        die("Error: " . mysqli_error($connection));
      }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/3.5.0/remixicon.css">
    <link rel="stylesheet" href="log.css">
</head>
<script type="text/javascript">

    function email_check()
    {
        let email = document.getElementById("mail").value;
        let outlook_check = /@outlook\.com$/;
        let gmail_check = /@gmail\.com$/;
        let yahoo_check = /@yahoo\.com$/;
        let domain_check = /\.(in|com)$/;
        let gmail = /^[a-zA-Z0-9._%+-]+@gmail\.com$/; 
        let yahoo = /^[a-zA-Z0-9._%+-]+@yahoo\.com$/; 
        let outlook = /^[a-zA-Z0-9._%+-]+@outlook\.com$/;
        let gmail1 = /^[a-zA-Z0-9._%+-]+@gmail\.in$/; 
        let yahoo1 = /^[a-zA-Z0-9._%+-]+@yahoo\.in$/; 
        let outlook1 = /^[a-zA-Z0-9._%+-]+@outlook\.in$/;
        let regex1 = /^\S+@\S+\.\S+$/; 
        let regex2 = /^[^!@#$%^&*()_+{}\[\]:;<>,.?~\\/-]/;

        if (outlook_check.test(email) == false && domain_check.test(email) == false){
            alert("Please Put Email provider or domain correctly")
            return false
        }
        if (gmail_check.test(email) == false && domain_check.test(email) == false){
            alert("Please Put Email provider or domain correctly")
            return false
        }
        if (yahoo_check.test(email) == false && domain_check.test(email) == false){
            alert("Please Put Email provider or domain correctly")
            return false
        }
        if (regex2.test(email) == false){
            alert("Email is Starting with Special Character")
            return false
        }
        if (regex1.test(email) == false){
            alert("Email contains White spaces!");
            return false
        }
        if (email == ""){
            alert("Email Field is blank!");
            return false
        }

        if (((gmail1.test(email) || gmail.test(email)) && domain_check.test(email)) 
        ||((yahoo1.test(email) || yahoo.test(email)) && domain_check.test(email)) 
        || ((outlook1.test(email) || outlook.test(email)) && domain_check.test(email))){
            return true
        }
    }

    function password_check(){
        let password = document.getElementById("pass").value;
        let containsLetters = /[a-zA-Z]/.test(password);
        let containsNumbers = /\d/.test(password);
        let containSpecial = /[!@#$%^&*(),.?":{}|<>]/.test(password);

        if (containsNumbers && containsLetters && containSpecial){
            return true
        }
        if (password.length < 8){
            alert("Password has less than 8 character")
            return false
        }
        else{
            alert("Not a Validate Password");
            return false
        }
    }

    function check()
    {
        mail_check = email_check();
        pass_check = password_check();
        if (mail_check && pass_check){
            alert("Logged In Successfully")
            return true
        }
        else{
            return false
        }
    }
</script>
<body>
    <section class="login">
        <img src="login2.jpg" alt="image" class="login__bg">
        <form onsubmit="return check()" class="login__form" method="get">
            <center>
                <h1>BOOK STORE</h1>
            </center><br>
            <hr><br>
            <h1 class="login__title">Login</h1>

            <div class="login__inputs">
                <div class="login__box">
                    <input type="email" placeholder="Email ID" class="login__input" id="mail" name="personal_mail" required>
                    <i class="ri-mail-fill" style="padding-right: 10px;"></i>
                </div>
                <div class="login__box">
                    <input type="password" placeholder="Password" class="login__input" name="pass_id" id="pass" required>
                    <i class="ri-lock-2-fill" style="padding-right: 10px;"></i>
                </div>
            </div>

            <div class="login__check">
                <div class="login__check-box">
                    <input type="checkbox" class="login__check-input" id="user-check">
                    <label for="user-check" class="login__check-label">Remember me</label>
                </div>
                <a href="" class="login__forget">Forget Password?</a>
            </div>
            <button type="submit" name="submit" class="login__button">Login</button>
            <div class="login__register">
                Don't have an account? <a href="/Register_Page/Register.html">Register</a>
            </div>
        </form>
</section>
</body>
</html>