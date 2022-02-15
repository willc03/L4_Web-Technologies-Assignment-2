<!--
    Author: Will Corkill
    Name: products.html
    Last Accessed: 13/01/2022
    Description: The page displaying all of the products to the user.
-->
<!DOCTYPE html>

<?php
    function getDatabaseConnection()
    {
        $dbServerName = "localhost";
        $username = "root";
        $password = "password";
        $connection = new mysqli($dbServerName, $username, $password, "web_technologies_ass2");
        while ($connection->connect_error)
        {
            $connection = new mysqli($dbServerName, $username, $password, "web_technologies_ass2");
        }
        return $connection;
    }
?>

<html lang="en"> <!-- Language is specified to increase SEO. -->

    <head> <!-- Content invisible to the user -->
        <title>Products - UCLan Student's Union Shop</title> <!-- Sets the name of the tab in the browser -->
        <link type="text/css" rel="stylesheet" href="../Stylesheets/global.css"> <!-- Style the header & footer of the page -->
        <link type="text/css" rel="stylesheet" href="../Stylesheets/products.css">
        <meta name="viewport" content="width=device-width, initial-scale=1"> <!-- Enable media queries & define charset -->
        <meta charset="utf-8">
        <script src="../Scripts/navigation.js"></script> <!-- Used to configure the hamburger menu -->
        <script src="../Scripts/manageCart.js"></script> <!-- This script provides local functions for managing the cart -->
    </head> 

    <body> <!-- Content in the body is visible to the user -->
        <div id="content">
            <div id="header"> <!-- Defines the top of the page, visible on all pages -->
                <a href="index.html"> <!-- Allows the UCLan logo to act as a button (Nikitha, 2018) -->
                    <img id="uclan_logo" src="../Images/uclan_logo.png" alt="University of Central Lancashire Logo">
                </a>
                <h2 id="title">Student Shop</h2>
                <input type="image" id="hamburger_menu" src="../Images/HamburgerMenu.svg" onclick="onMenuMouseDown()" alt="Menu toggle"> <!-- Create the hamburger menu for mobile-sized devices with click event (w3schools, n.d. b) -->
                <nav id="navigation"> <!-- Create anchors and container for all navigation. -->
                    <a href="index.php">Home</a>
                    <a href="products.php">Products</a>
                    <a href="cart.php">Cart</a>
                </nav>
            </div>
            <div id="mobileNavigationContainer"></div>

            <div id="main">
                <!--
                    The below paragraph contains anchor tags which can scroll to certain points on the page by using the ID of an
                    element which is being scrolled to, in this case, the IDs are the names of the products, and upon pressing, the
                    browser will scroll to the top of container with such an ID.

                    The containers with said IDs are shown below the "quick_scroller" paragraph.
                -->
                <p id="quick_scroller">products > <a href="#Hoodie">hoodies</a> <a href="#Jumper">jumpers</a> <a href="#Tshirt">t-shirts</a></p>
                <div id="products">
                <?php
                    $dbConnection = getDatabaseConnection(); // Connect to the database
                    $selectProducts = "SELECT * FROM products;"; // Write a query to fetch all the products
                    $sqlResult = $dbConnection->query($selectProducts); // Execute the query

                    if ($sqlResult and $sqlResult->num_rows > 0) // Check if the results exist
                    {
                        while ($product = $sqlResult->fetch_assoc()) // Fetch each row
                        {
                            $getProductTypeInfo = 'SELECT productTypeDescription, price FROM productTypes WHERE productType="' . $product["product_type"] . '";';
                            $sqlProductInfo = $dbConnection->query($getProductTypeInfo);
                            $productInfo = $sqlProductInfo->fetch_row();
                            $productDescription = $productInfo[0];
                            $productPrice = $productInfo[1];

                            // Start container
                            echo '<div class="productContainer">'; // Display the results to the user.
                            echo '<img src="' . $product["product_image"] . '">';
                            echo '<h2>' . $product["colour"] . '</h2>';
                            echo '<h2>' . $product["product_type"] . '</h2>';
                            echo '<p class="productDescription">' . $productDescription . '</p>';
                            // A small form will be used to redirect the user when they press read more
                            echo '<form action="item.php" method="post">';
                            echo '<input type="hidden" name="product_id" id="product_id" value="' . $product["product_id"] . '">';
                            echo '<input class="new_line read_more" type="submit" name="readMoreClick" value="Read more...">';
                            echo '</form>'; // End form
                            echo '<strong class="productPrice"> £' . $productPrice . '</strong>';
                            // Create buy button
                            echo '<input type="button" class="purchaseButton" value="Buy" onclick="addToCart(\'' . $product["product_type"] . '\', \'' . $product["colour"] . '\')">';
                            // End container
                            echo '</div>';
                        }
                    }
                ?>
                </div>
                <input type="button" id="top_scroller" value="Top" onclick="document.getElementById('header').scrollIntoView()"> <!-- Add a button to take the user back to the top of the page. -->
            </div>
        </div>

        <footer id="footer"> <!-- Defines the bottom of the page, containing all information about the website and company. -->
            <div class="Links"> <!-- All sections are placed into containers to make flexbox consistent on all screen sizes -->
                <h3 class="category">Links</h3>
                <a href="https://www.uclansu.co.uk">Student's Union</a>
            </div>
            <div class="Contact">
                <h3 class="category">Contact</h3>
                <p>Email: <a href="mailto:suinformation@uclan.ac.uk">suinformation@uclan.ac.uk</a></p> <!-- mailto will open the user's email client when pressed (RapidTables, n.d.) -->
                <p>Phone: <a href="tel:01772893000">01772 893000</a></p> <!-- tel will ask the user if they want to phone the number, if available (W3Docs, n.d.) -->
            </div>
            <div class="Location">
                <h3 class="category">Location</h3>
                <p>University of Central Lancashire Student's Union</p> <!-- Paragraph styling has been applied so all of these paragraphs appear as an address -->
                <p>Fylde Road, Preston, PR1 7BY</p>
                <p>Registered in England</p>
                <p>Company Number: 7623917</p>
                <p>Registered Charity Number: 1142616</p>
            </div>
        </footer>
    </body>

</html>