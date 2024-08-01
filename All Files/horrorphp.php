<?php
    include 'config1.php';

    if(isset($_REQUEST["submit"])){
        
        $ins = "INSERT into Register_Details(Full_Name, Date_of_Birth, Phone_Number, Email_ID,Personal_Password) VALUES ('$name','$date_of_birth', '$number', '$email', '$password')";
        $query = mysqli_query($connection , $ins);
        // echo "<script>alert('Successfully Logged In');</script>";
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
    <title>Horror Book Store</title>
 <a href="homepage.html" style="position: fixed; top: 20px; left: 20px; z-index: 999; color: #dc143c; font-size: 25px; text-decoration: none;">
        <img src="haunted_home.png" alt="Home" style="width: 40px; height: 40px; vertical-align: middle;"> Home
    </a>
<style>
    body {
        background-image: url('horrorpagebackg.jpeg');
        background-repeat: no-repeat;
        background-size: cover;
        font-size: 30px;
        margin-top: -20px; 
    }

    h1 {
        text-align: center;
        margin-top: 20px; 
    }

    #bookContainer {

        display: flex;
        flex-wrap: wrap;
        justify-content: space-around;
    }
    

    .book {
        position: relative;
        text-align: center;
        border: 1px solid #FFFFFF;
        margin: 10px;
        padding: 10px;
        width: 300px;
        height: 800px;
        display: flex;
        flex-direction: column;
        justify-content: space-between; 
        background-color: rgba(255, 255, 255, 0.1); 
        border-radius: 10px; 
    }

    .book img {
        max-width: 100%;
        height: 62%;
        object-fit: cover;
        margin-bottom: 10px; 
        max-height: 62%
    }

    #filterContainer,
    #searchContainer,
    #cartContainer {
        text-align: center;
        margin-top: 20px;
    }

    select,
    #searchInput {
        padding: 5px;
        margin: 5px;
    }

    #cartIcon {
        position: fixed;
        top: 30px; 
        right: 30px;
        cursor: pointer;
    }

    #cartIcon img {
        max-width: 50px;
        height: auto;
    }

    #cartList {
        list-style-type: none;
        padding: 0;
        display: none;
        position: fixed;
        top: 30px; 
        right: 10px;
        background-color: #ffffff;
        border: 1px solid #66b2ff;
        border-radius: 5px;
        padding: 10px;
        max-width: 300px;
        z-index: 999;
        font-size: 30px;
    }

    #cartList li {
        margin-bottom: 10px;
        font-size: 20px;
    }

    .book p {
        margin-bottom: 5px; 
    }
    .book button {
        width: 300px;  
        height: 45px; 
        background-color: #dc143c;
        color: #ffffff;
        border: none;
        cursor: pointer;
        border-radius: 5px;
        margin-top: auto;
        font-size: 30px; 
    }

    .stars {
        display: flex;
        justify-content: center; 
        align-items: center; 
        height: 30px;
        margin-bottom: 22px;
    }

    .star {
        color: gold;
        font-size: 30px; 
        margin: 0 2px; 
    }


    #cartList {
        position: fixed;
        top: 60px;
        right: 10px;
        background-color: rgba(255, 255, 255, 0.9);
        border: 1px solid #dc143c;
        border-radius: 5px;
        padding: 10px;
        max-width: 300px;
        z-index: 999;
        font-size: 16px;
        display: none; 
        text-align: left;
    }

    #cartList h2 {
        margin-bottom: 10px;
    }

    #cartList ul {
        list-style-type: none;
        padding: 0;
        margin-bottom: 10px;
    }

    #totalAmount {
        text-align: right;
        margin-top: 10px;
    }
    .quantity {
        display: inline-block;
        border: 2px solid #dc143c;
        border-radius: 50%;
        width: 30px;
        height: 30px;
        margin: 0 5px;
        line-height: 26px;
        text-align: center;
        font-size: 20px;
        color: #dc143c;
        cursor: pointer;
    }
</style>
</head>
<body>
    <h1 style="color: #dc143c">Horror Book Store</h1>
   
    <div id="filterContainer">
        <p style="color: #dc143c">
            <label for="priceFilter">Sort by Price:</label>
            <select id="priceFilter" onchange="sortBooks()" style="width: 150px;font-size: 20px; color: black;background-color: red; ">
                <option value="#" disabled>Sort Price</option>
                <option value="lowToHigh">Low to High</option>
                <option value="highToLow">High to Low</option>
            </select>

           <label for="ratingFilter">Sort by Rating:</label>
            <select id="ratingFilter" onchange="sortBooks()" style="width: 200px; background-color: red; color: black; border: none; font-size: 20px">
                <option value="all" style="background-color: red; color: black;">All Ratings</option>
                <option value="5">5 Stars</option>
                <option value="4">4 Stars & Above</option>
                <option value="3">3 Stars & Above</option>
            </select>
        </p>
    </div>

    <div id="searchContainer">
        <p style="color: #dc143c">
            <label for="searchInput">Search Books:</label>
            <input type="text" id="searchInput" oninput="searchBooks()" style="background-color: red; color: black; border: none; font-size: 20px; border-radius: 5px;">
        </p>
    </div>

    <div id="bookContainer">
        <div class="book" data-price="20" data-rating="5" data-name="Book 1">
            <img src="Horror1.jpg" alt="Book 1">
            <p style="color: #dc143c">BLACK FOREST</p>
            <p style="color: #dc143c">$20.00</p>
            <div class="stars">

            </div>
            <button onclick="addToCart('BLACK FOREST', 20)" style="font-size: 20px;">Add to Cart</button>
            <button onclick="leaveReview('BLACK FOREST')" style="font-size: 20px; margin-top: 10px;">Leave Review</button>
        </div>
        <div class="book" data-price="15" data-rating="4" data-name="Book 2">
            <img src="Horror2.jpg" alt="Book 2">
            <p style="color: #dc143c">THE CARRIE</p>
            <p style="color: #dc143c">$15.00</p>
            <div class="stars">

            </div>
            <button onclick="addToCart('THE CARRIE', 15)"style="font-size: 20px;">Add to Cart</button>
            <button onclick="leaveReview('THE CARRIE')" style="font-size: 20px; margin-top: 10px;">Leave Review</button>
        </div>
        <div class="book" data-price="25" data-rating="3" data-name="Book 3">
            <img src="Horror3.jpg" alt="Book 3">
            <p style="color: #dc143c">THE EXORCIST</p>
            <p style="color: #dc143c">$25.00</p>
            <div class="stars">

            </div>
            <!-- <button onclick="leaveReview('BLACK FOREST')" style="font-size: 20px;">Leave Review</button> -->
            <button onclick="addToCart('THE EXORCIST', 25)"style="font-size: 20px;">Add to Cart</button>
            <button onclick="leaveReview('THE EXORCIST')" style="font-size: 20px; margin-top: 10px;">Leave Review</button>
        </div>
        <div class="book" data-price="18" data-rating="4" data-name="Book 4">
            <img src="Horror4.jpg" alt="Book 4">
            <p style="color: #dc143c">THOSE EYES</p>
            <p style="color: #dc143c">$18.00</p>
            <div class="stars">

            </div>
            <button onclick="addToCart('THOSE EYES', 18)"style="font-size: 20px;">Add to Cart</button>
            <button onclick="leaveReview('THOSE EYES')" style="font-size: 20px; margin-top: 10px;">Leave Review</button>
        </div>
        <div class="book" data-price="30" data-rating="5" data-name="Book 5">
            <img src="Horror5.jpg" alt="Book 5">
            <p style="color: #dc143c">COLD DRESSES</p>
            <p style="color: #dc143c">$30.00</p>
            <div class="stars">

            </div>
            <button onclick="addToCart('COLD DRESSES', 30)"style="font-size: 20px;">Add to Cart</button>
            <button onclick="leaveReview('COLD DRESSES')" style="font-size: 20px; margin-top: 10px;">Leave Review</button>
        </div>
        <div class="book" data-price="22" data-rating="3" data-name="Book 6">
            <img src="Horror6.jpg" alt="Book 6">
            <p style="color: #dc143c">THE FERVOR</p>
            <p style="color: #dc143c">$22.00</p>
            <div class="stars">
                <!-- Dynamic stars -->
            </div>
            <button onclick="addToCart('THE FERVOR', 22)"style="font-size: 20px;">Add to Cart</button>
            <button onclick="leaveReview('THE FERVOR')" style="font-size: 20px; margin-top: 10px;">Leave Review</button>
        </div>
        <div class="book" data-price="29" data-rating="4" data-name="Book 7">
            <img src="it.jpeg" alt="Book 7">
            <p style="color: #dc143c">IT</p>
            <p style="color: #dc143c">$29.00</p>
            <div class="stars">
                
            </div>
            <button onclick="addToCart('IT', 29)"style="font-size: 20px;">Add to Cart</button>
            <button onclick="leaveReview('IT')" style="font-size: 20px; margin-top: 10px;">Leave Review</button>
        </div>
        <div class="book" data-price="25" data-rating="5" data-name="Book 8">
            <img src="the_shining.jpeg" alt="Book 8">
            <p style="color: #dc143c">THE SHINING</p>
            <p style="color: #dc143c">$25.00</p>
            <div class="stars">
                
            </div>
            <button onclick="addToCart('THE SHINING', 25)"style="font-size: 20px;">Add to Cart</button>
            <button onclick="leaveReview('THE SHINING')" style="font-size: 20px; margin-top: 10px;">Leave Review</button>
        </div>
    </div>

    <div id="cartIcon" onclick="toggleCart()">
        <img src="final_horror_cart.png" alt="Cart Icon">
    </div>

<div id="cartList" style="max-width: 400px; ">
    <h2 style="color: #dc143c;">Shopping Cart</h2>
    <ul id="cartItems"></ul>
    <p id="totalAmount" style="color: #dc143c; font-size: 20px; margin-top: 10px;">Total: $0.00</p>
    <button onclick="pay()" style="font-size: 30px; margin-top: 10px;color: #FFFFFF;background-color: #dc143c;border-radius:10px; width: 400px;">Pay Now</button>
</div>


    <script>
        let totalAmount = 0; 

        function sortBooks() {
    const priceFilter = document.getElementById('priceFilter').value;
    const ratingFilter = document.getElementById('ratingFilter').value;
    const bookContainer = document.getElementById('bookContainer');
    const books = Array.from(bookContainer.querySelectorAll('.book'));
    bookContainer.innerHTML = ''; 


    books.forEach(book => {
        bookContainer.appendChild(book); 
    
        book.style.display = 'block'; 
        const rating = parseInt(book.getAttribute('data-rating'));
        if (ratingFilter !== 'all' && rating < parseInt(ratingFilter)) {
            book.style.display = 'none'; 
        }
    });

    if (priceFilter === 'highToLow') {
        books.sort((a, b) => {
            const priceA = parseFloat(a.getAttribute('data-price'));
            const priceB = parseFloat(b.getAttribute('data-price'));
            return priceB - priceA;
        });
    } else {
        books.sort((a, b) => {
            const priceA = parseFloat(a.getAttribute('data-price'));
            const priceB = parseFloat(b.getAttribute('data-price'));
            return priceA - priceB;
        });
    }

    bookContainer.innerHTML = ''; 
    books.forEach(book => {
        bookContainer.appendChild(book); 
    });
}


        function searchBooks() {
            const searchInput = document.getElementById('searchInput').value.toLowerCase();
            const books = document.querySelectorAll('.book');

            books.forEach((book) => {
                const bookTitle = book.querySelector('p').textContent.toLowerCase();
                if (bookTitle.includes(searchInput)) {
                    book.style.backgroundColor = 'white'; 
                } else {
                    book.style.backgroundColor = ''; 
                }
            });
        }

        function addToCart(bookName, price) {
            const cartItems = document.getElementById('cartItems');
            const li = document.createElement('li');
            li.textContent = `${bookName} - $${price}`;
            const plusButton = document.createElement('span');
        plusButton.textContent = '+';
        plusButton.classList.add('quantity');
        plusButton.onclick = function() {
            const quantityElement = this.nextElementSibling;
            const quantity = parseInt(quantityElement.textContent);
            quantityElement.textContent = quantity + 1;
            totalAmount += price;
            updateTotalAmount();
        };
        li.appendChild(plusButton);
const quantityDisplay = document.createElement('span');
        quantityDisplay.textContent = '1';
        quantityDisplay.classList.add('quantity');
        li.appendChild(quantityDisplay);
        

       const minusButton = document.createElement('span');
        minusButton.textContent = '-';
        minusButton.classList.add('quantity');
        minusButton.onclick = function() {
            const quantityElement = this.previousElementSibling;
            const quantity = parseInt(quantityElement.textContent);
            if (quantity > 0) {
                quantityElement.textContent = quantity - 1;
                totalAmount -= price;
                updateTotalAmount();
            }
        };
        li.appendChild(minusButton);
        
        cartItems.appendChild(li);
        totalAmount += price;
        updateTotalAmount();
        }

        function updateTotalAmount() {
        const totalAmountElement = document.getElementById('totalAmount');
        if (totalAmountElement) {
            totalAmountElement.textContent = `Total: $${totalAmount.toFixed(2)}`;
        }
        }

        function toggleCart() {
            const cartList = document.getElementById('cartList');
            cartList.style.display = cartList.style.display === 'none' ? 'block' : 'none';
        }

        function pay() {
            sessionStorage.setItem('totalAmount', totalAmount);
            window.location.href = 'paymentpage.html';
        }


        document.addEventListener('DOMContentLoaded', function() {
            const books = document.querySelectorAll('.book');
            books.forEach(book => {
                const rating = parseInt(book.getAttribute('data-rating'));
                const starsContainer = book.querySelector('.stars');
                for (let i = 0; i < rating; i++) {
                    const starIcon = document.createElement('span');
                    starIcon.classList.add('star');
                    starIcon.textContent = '★';
                    starsContainer.appendChild(starIcon);
                }
            });
        });
    </script>
</body>
</html>
