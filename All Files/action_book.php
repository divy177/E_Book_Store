<?php
include 'config4.php';

$sql = "SELECT Full_Name, Book_Title, Query, Rating FROM review";

// Execute the query
$result = $connection->query($sql);

// Initialize an empty array to store review data
$reviews = array();
if ($result->num_rows > 0) {
    // Loop through each row of data
    while($row = $result->fetch_assoc()) {
        // Store review data in the array
        $reviews[] = $row;
    }
} else {
    // No reviews found
    echo "No reviews found";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Action Book Store</title>
 <a href="homepage.html" style="position: fixed; top: 20px; left: 20px; z-index: 999; color: rgb(113, 7, 211); font-size: 25px; text-decoration: none;">
        <img src="actio_home_image.png" alt="Home" style="width: 45px; height: 45px; vertical-align: middle;"> Home
    </a>
<style>
    body {
        background-image: url('action_back.jpg');
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
        height: 670px;
        display: flex;
        flex-direction: column;
        justify-content: space-between; 
        background-color: rgba(255, 255, 255, 0.1); 
        border-radius: 10px; 
        backdrop-filter: blur(16px);
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
        z-index: 1000;
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
        background-color: blueviolet;
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
        font-size: 40px; 
        margin: 0 2px; 
    }


    #cartList {
        list-style-type: none;
        padding: 0;
        display: none;
        position: fixed;
        top: 80px;
        right: 10px;
        background-color: rgba(255, 255, 255, 0.9);
        border: 1px solid blueviolet;
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
        border: 2px solid 	blueviolet;
        border-radius: 50%;
        width: 30px;
        height: 30px;
        margin: 0 5px;
        line-height: 26px;
        text-align: center;
        font-size: 20px;
        color: 	#702963;
        cursor: pointer;
    }

    #reviewButton{
        font-size: 20px; 
        position: fixed; 
        top: 34px; 
        right: 100px; 
        background-color: blueviolet; 
        color: #ffffff; 
        padding: 10px; 
        border-radius: 5px; 
        text-decoration: none;
        z-index: 1000;
    }
    .review-card {
        border: 1px solid #fff;
        border-radius: 10px;
        padding: 20px;
        margin: 10px;
        background-color: rgba(255, 255, 255, 0.122); 
        backdrop-filter: blur(20px);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        width: 100%; 
        max-width: 300px;
        display: inline-block;
        vertical-align: top;
        text-align: center;
    }

    .review-card h2 {
        color: blueviolet;
        font-size: 30px;
        margin-bottom: 10px;
    }

    .review-card p {
        color: #fff;
        font-size: 22px;
        line-height: 1.6;
    }
    .clearfix::after {
        content: "";
        clear: both;
        display: table;
    }
    #reviewContainer {
        width: 100%; 
        overflow-x: auto; 
        white-space: nowrap; 
    }
</style>
</head>
<body>
    <h1 style="color: 	blueviolet">Action Book Store</h1>
   
    <div id="filterContainer">
        <p style="color: 	blueviolet">
            <label for="priceFilter">Sort by Price:</label>
            <select id="priceFilter" onchange="sortBooks()" style="width: 150px;font-size: 20px; color: white;background-color: blueviolet; ">
                <option value="#" disabled>Sort Price</option>
                <option value="lowToHigh">Low to High</option>
                <option value="highToLow">High to Low</option>
            </select>

           <label for="ratingFilter">Sort by Rating:</label>
            <select id="ratingFilter" onchange="sortBooks()" style="width: 200px; background-color: blueviolet; color: white; border: none; font-size: 20px">
                <option value="all" style="background-color: blueviolet; color: white;">All Ratings</option>
                <option value="5">5 Stars</option>
                <option value="4">4 Stars & Above</option>
                <option value="3">3 Stars & Above</option>
            </select>
        </p>
    </div>

    <div id="searchContainer">
        <p style="color: 	blueviolet">
            <label for="searchInput">Search Books:</label>
            <input type="text" id="searchInput" oninput="searchBooks()" style="background-color: blueviolet; color: white; border: none; font-size: 20px; border-radius: 5px;">
        </p>
    </div>

    <div id="cartIcon" onclick="toggleCart()">
        <img src="drama_cart.png" alt="Cart Icon">
    </div>
    <a href="action_review.php" id="reviewButton">Leave Review</a>

    <div id="bookContainer">
        <div class="book" data-price="20" data-rating="5" data-name="Book 1">
            <img src="Action1.jpg" alt="Book 1">
            <p style="color: 	blueviolet">LONE WOLF</p>
            <p style="color: 	blueviolet">$20.00</p>
            <div class="stars">

            </div>
            <button onclick="addToCart('LONE WOLF', 20)" style="font-size: 20px;">Add to Cart</button>

        </div>
        <div class="book" data-price="15" data-rating="4" data-name="Book 2">
            <img src="Action2.jpg" alt="Book 2">
            <p style="color: 	blueviolet">THE COLD STORM</p>
            <p style="color: 	blueviolet">$15.00</p>
            <div class="stars">

            </div>
            <button onclick="addToCart('THE COLD STORM', 15)"style="font-size: 20px;">Add to Cart</button>
        </div>
        <div class="book" data-price="25" data-rating="3" data-name="Book 3">
            <img src="Action3.jpg" alt="Book 3">
            <p style="color: 	blueviolet">THE KING OF DRUGS</p>
            <p style="color: 	blueviolet">$25.00</p>
            <div class="stars">

            </div>
            <button onclick="addToCart('THE KING OF DRUGS', 25)"style="font-size: 20px;">Add to Cart</button>
        </div>
        <div class="book" data-price="18" data-rating="4" data-name="Book 4">
            <img src="Action4.jpg" alt="Book 4">
            <p style="color: 	blueviolet">DESTROYER</p>
            <p style="color: 	blueviolet">$18.00</p>
            <div class="stars">

            </div>
            <button onclick="addToCart('DESTROYER', 18)"style="font-size: 20px;">Add to Cart</button>
        </div>
        <div class="book" data-price="30" data-rating="5" data-name="Book 5">
            <img src="Action5.jpg" alt="Book 5">
            <p style="color: 	blueviolet">MIDNIGHT GAMBIT</p>
            <p style="color: 	blueviolet">$30.00</p>
            <div class="stars">

            </div>
            <button onclick="addToCart('MIDNIGHT GAMBIT', 30)"style="font-size: 20px;">Add to Cart</button>
        </div>
        <div class="book" data-price="22" data-rating="3" data-name="Book 6">
            <img src="Action6.jpg" alt="Book 6">
            <p style="color: 	blueviolet">DEEP SHADOW</p>
            <p style="color: 	blueviolet">$22.00</p>
            <div class="stars">
                <!-- Dynamic stars -->
            </div>
            <button onclick="addToCart('DEEP SHADOW', 22)"style="font-size: 20px;">Add to Cart</button>
        </div>
        <div class="book" data-price="29" data-rating="4" data-name="Book 7">
            <img src="Action8.jpeg" alt="Book 7">
            <p style="color: 	blueviolet">ELIXIR PROJECT</p>
            <p style="color: 	blueviolet">$29.00</p>
            <div class="stars">
                
            </div>
            <button onclick="addToCart('ELIXIR PROJECT', 29)"style="font-size: 20px;">Add to Cart</button>
        </div>
        <div class="book" data-price="25" data-rating="5" data-name="Book 8">
            <img src="the_shining.jpeg" alt="Book 8">
            <p style="color: 	blueviolet">THE SHINING</p>
            <p style="color: 	blueviolet">$25.00</p>
            <div class="stars">
                
            </div>
            <button onclick="addToCart('THE SHINING', 25)"style="font-size: 20px;">Add to Cart</button>
        </div>

        <div class="book" data-price="25" data-rating="5" data-name="Book 9">
            <img src="losthorizon.jpeg" alt="Book 8">
            <p style="color: 	blueviolet">LOST HORIZON</p>
            <p style="color: 	blueviolet">$25.00</p>
            <div class="stars">
                
            </div>
            <button onclick="addToCart('LOST HORIZON', 25)"style="font-size: 20px;">Add to Cart</button>
        </div>

        <div class="book" data-price="25" data-rating="5" data-name="Book 10">
            <img src="readyplayerone.jpeg" alt="Book 8">
            <p style="color: 	blueviolet">READY PLAYER ONE</p>
            <p style="color: 	blueviolet">$25.00</p>
            <div class="stars">
                
            </div>
            <button onclick="addToCart('READY PLAYER ONE', 25)"style="font-size: 20px;">Add to Cart</button>
        </div>

        
    </div>

    

<div id="cartList" style="max-width: 400px; ">
    <h2 style="color: blueviolet">Shopping Cart</h2>
    <ul id="cartItems"></ul>
    <p id="totalAmount" style="color: blueviolet; font-size: 20px; margin-top: 10px;">Total: $0.00</p>
    <button onclick="pay()" style="font-size: 30px; margin-top: 10px;color: #FFFFFF;background-color: blueviolet;border-radius:10px; width: 400px;">Pay Now</button>
</div>

<h1 style="color: blueviolet; text-align: center !important; margin-left: 30px">Reviews</h1>
    <div class="clearfix"></div>
    <div id="reviewContainer" style="color: blueviolet;">
        <?php
        foreach ($reviews as $review) {
            echo "<div class='review-card' data-rating='" . $review['Rating'] . "'>";
            echo "<h2>" . $review["Full_Name"] . "</h2>";
            echo "<p>" . $review["Book_Title"] . "</p>";
            echo "<p>" . $review["Query"] . "</p>";
            $rating = intval($review["Rating"]);
            echo "<div class='stars'>";

            echo "</div>";
            echo "</div>";
        }
        ?>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
        const reviews = document.querySelectorAll('.review-card'); 

            reviews.forEach(review => {
                const rating = parseInt(review.getAttribute('data-rating')); 
                const starsContainer = review.querySelector('.stars'); 

                for (let i = 0; i < rating; i++) {
                    const starIcon = document.createElement('span'); 
                    starIcon.classList.add('star'); 
                    starIcon.textContent = '★';// Add Font Awesome classes for star icon
                    starIcon.style.color = 'gold'; // Set the color of the star to gold
                    starsContainer.appendChild(starIcon); // Append the star icon to the stars container
                }
            });
        });

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
                if (quantity === 1){
                    this.parentElement.remove();
                }
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
