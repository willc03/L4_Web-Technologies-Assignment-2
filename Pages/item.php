<!--
    Author: Will Corkill
    Name: item.html
    Last Accessed: 13/01/2022
    Description: The page which will display a specific item. Only accessible via clicking on an item.
-->
<!DOCTYPE html>

<?php
    session_start();
    if (!isset($_POST["product_id"])) // If the user has tried to access this page without selecting a product, they will be redirected to another page
    {
        header("Location: ./products.php"); // Send the user back to the products page.
        exit(); // End this PHP script before the function is generated to save memory.
    }

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
        <title><?php echo $_POST["title"] . " - UCLan Student's Union Shop"; ?></title> <!-- PHP will be used to edit the name of the tab -->
        <link type="text/css" rel="stylesheet" href="../Stylesheets/global.css"> <!-- Style the header & footer of the page -->
        <link type="text/css" rel="stylesheet" href="../Stylesheets/item.css"> <!-- The unique CSS file for this page -->
        <meta name="viewport" content="width=device-width, initial-scale=1"> <!-- Enable media queries & define charset -->
        <meta charset="utf-8">
        <script src="../Scripts/navigation.js"></script> <!-- Used to configure the hamburger menu -->
        <script src="../Scripts/ajaxRequests.js"></script> <!-- Ajax is used to communicate between the client and the server -->
        <script src="../Scripts/manageCart.js"></script> <!-- This script provides local functions for managing the cart -->
    </head>

    <body> <!-- Content in the body is visible to the user -->
        <div id="content">
            <div id="header"> <!-- Defines the top of the page, visible on all pages -->
                <a href="index.html"> <!-- Allows the UCLan logo to act as a button (Nikitha, 2018) -->
                    <img id="uclan_logo" src="../Images/uclan_logo.png" alt="University of Central Lancashire Logo">
                </a>
                <h2 id="title">Student Shop</h2>
                <input type="image" id="hamburger_menu" src="../Images/HamburgerMenu.svg" onclick="onMenuMouseDown()" alt="Menu toggle"> <!-- Create the hamburger menu for mobile-sized devices with click event (w3schools, n.d.) -->
                <nav id="navigation"> <!-- Create anchors and container for all navigation. -->
                    <a href="index.php">Home</a>
                    <a href="products.php">Products</a>
                    <a href="cart.php">Cart</a>
                    <?php
                        echo '<button id="clearButton" onclick="UserAccountRequest(this.innerHTML)">' . (isset($_SESSION["name"]) ? 'Log out' : 'Sign in') . '</button>';;
                    ?>
                </nav>
            </div>
            <div id="mobileNavigationContainer"></div>

            <div id="main"> <!-- The DOM will be manipulated to display content in this container. -->
                <?php
                    $dbConnection = getDatabaseConnection();
                    $getProductInfo = 'SELECT * FROM products WHERE product_id="' . $_POST["product_id"] . '";'; // Search for the product in the database by the product ID.
                    $sqlProductInfo = $dbConnection->query($getProductInfo);
                    $productInfo = $sqlProductInfo->fetch_assoc();

                    $getProductTypeInfo = 'SELECT productTypeDescription, price FROM productTypes WHERE productType="' . $productInfo["product_type"] . '";';
                    $sqlProductTypeInfo = $dbConnection->query($getProductTypeInfo);
                    $productTypeInfo = $sqlProductTypeInfo->fetch_assoc();
                    $productInfo["price"] = $productTypeInfo["price"];
                    $productInfo["description"] = $productTypeInfo["productTypeDescription"];

                    // Start container
                    echo '<div class="productContainer">'; // Display the results to the user.
                    echo '<img src="' . $productInfo["product_image"] . '">';
                    echo '<h2>' . $productInfo["colour"] . '</h2>';
                    echo '<h2>' . $productInfo["product_type"] . '</h2>';
                    echo '<p class="productDescription">' . $productInfo["description"] . '</p>';
                    echo '<strong class="productPrice"> £' . $productInfo["price"] . '</strong>';
                    // Create buy button
                    echo '<input type="button" class="purchaseButton" value="Buy" onclick="addToCart(\'' . $productInfo["product_type"] . '\', \'' . $productInfo["colour"] . '\')">';
                    // End container
                    echo '</div>';
                ?>
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