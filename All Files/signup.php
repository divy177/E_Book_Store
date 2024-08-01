<?php
    include 'config1.php';

    if(isset($_REQUEST["submit"])){
        $name = $_REQUEST["full_name"];
        $date_of_birth = $_REQUEST["dob"];
        $number = $_REQUEST["no"];
        $email = $_REQUEST["personal_mail"];
        $password = $_REQUEST["personal_pass"];
    
        $ins = "INSERT into Register_Details(Full_Name, Date_of_Birth, Phone_Number, Email_ID,Personal_Password) VALUES ('$name','$date_of_birth', '$number', '$email', '$password')";
        $query = mysqli_query($connection , $ins);
        echo "<meta http-equiv='refresh' content='0;url=login.php'>";
        
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
    <title>Starter Template</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/3.5.0/remixicon.css">
    <link rel="stylesheet" href="reg.css">
</head>
<script>
    function email_check()
    {
        let email = document.getElementById("mail").value;
        let email1 = document.getElementById("mail").value.trim();
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
        let provider = email1.split('@')[1]

        // if (provider && (provider.toLowerCase() === 'gmail.com' || provider.toLowerCase() === 'gmail.in')){
        //     alert("Please Put Email provider or domain correctly")
        //     return false
        // }
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

    function name_check()
    {
        let fullName = document.getElementById("fname").value;
        let nameRegex = /^[A-Za-z\s]+$/.test(fullName)
        let parts = fullName.split(' ');
        if (parts.length === 2 && parts[0].trim() !== "" && parts[1].trim() !== ""){
            return true;
        }else{
            return false;
        }
    }
    
    function phone_check()
    {
        let num =  document.getElementById("phone").value;
        let regex = /\d/.test(num);
        let regex1 = /[a-zA-Z]/.test(num)
        if (regex){
            return true
        }
        if (regex1){
            alert("Number also has alphabet")
            return false
        }
        if (num.length < 10){
            alert("Number has less than 10 no.")
            return false
        }
    }

    function check()
    {
        fname_check = name_check();
        number_check = phone_check()
        mail_check = email_check();
        pass_check = password_check();
        if (mail_check && pass_check && fname_check && number_check){
            alert("Logged In Successfully")
            return true
        }
        else{
            return false
        }
    }
</script>
<body>    
    <div class="login">
        <img src="register_image.jpeg" alt="image" class="login__bg">
        <form onsubmit="return check()" class="login__form">
            <center>
                <h1>BOOK STORE</h1>
            </center>
            <hr><br>
            <h1 class="login__title">Register</h1>
            <div class="login__inputs">
                <div class="login__box">
                    <input type="text" placeholder="Full Name" name="full_name" class="login__input" id="fname" required>
                    <i class="ri-user-line" style="padding-right: 10px;"></i>
                </div>
                <div class="login__box">
                    <input type="date" placeholder="Date of Birth" name="dob" class="login__input" required>
                    <i class="ri-calendar-2-line" style="padding-right: 10px;"></i>
                </div>
                <div class="login__box">
                    <input type="text" placeholder="Phone Number" name="no" class="login__input" id="phone" required>
                    <i class="ri-phone-line" style="padding-right:10px"></i>
                </div>
                <div class="login__box">
                    <input type="email" placeholder="Email ID" name="personal_mail" class="login__input" id="mail" required>
                    <i class="ri-mail-fill" style="padding-right: 10px;"></i>
                </div>
                <div class="login__box">
                    <input type="password" placeholder="Password" name="personal_pass" class="login__input" id="pass" required>
                    <i class="ri-lock-2-fill" style="padding-right: 10px;"></i>
                </div>
            </div>
            <div class="login__check">
                <div class="login__check-box">
                    <input type="checkbox" class="login__check-input" id="user-check">
                    <label for="user-check" class="login__check-label">Remember me</label>
                </div>
            </div>
            <button type="submit" name="submit" onclick="name_check()" class="login__button">Register</button>
        </form>
    </div>
    
</body>
</html>