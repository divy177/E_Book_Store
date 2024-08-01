<?php

include 'config6.php';

if(isset($_REQUEST["submit"])){
  $name = $_REQUEST["name"];
  $book = $_REQUEST["book_title"];
  $rate = $_REQUEST["rating"];
  $question = $_REQUEST["query"];

  $ins = "INSERT into review(Full_Name, Book_Title, Rating, Query) VALUES ('$name','$book','$rate','$question')";
  $query = mysqli_query($connection , $ins);
  echo "<script>alert('Review Successfully Submitted');</script>";
  echo "<meta http-equiv='refresh' content='0;url=love.php'>";
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
<body>    
    <div class="login">
        <img src="romback.jpg" alt="image" class="login__bg">
        <form onsubmit="" action="#" class="login__form">
            <center>
                <h1>BOOK STORE</h1>
            </center>
            <hr><br>
            <h1 class="login__title">Customer Review
            </h1>
            <div class="login__inputs">
                <div class="login__box">
                    <input type="text" placeholder="Full Name" class="login__input" id="fname" name="name" required>
                    <i class="ri-user-line" style="padding-right: 10px;"></i>
                </div>
                <div class="login__box">
                    <input type="text" placeholder="Enter Book Title" class="login__input" id="phone" name="book_title" required>
                    <i class="ri-book-fill" style="padding-right: 10px;"></i>
                </div>
                <div class="login__box">
                    <input type="text" placeholder="Rating (1-5)" class="login__input" id="mail" name="rating"required>
                    <i class="ri-mail-fill" style="padding-right: 10px;"></i>
                </div>
                <div class="login__box">
                    <input type="text" placeholder="Write Review" class="login__input" id="pass" name="query" required>
                    <i class="ri-sticky-note-line" style="padding-right: 10px;"></i>
                </div>
            </div>
            <button type="submit" name="submit" class="login__button">Submit</button>
        </form>
    </div>
    
</body>
</html>