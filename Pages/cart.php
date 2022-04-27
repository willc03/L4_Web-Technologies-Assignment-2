<!--
    Author: Will Corkill
    Name: cart.html
    Last Accessed: 13/01/2022
    Description: Displays the user's currently selected items.
-->
<!DOCTYPE html>

<?php
    session_start();
    require "../Scripts/Server/Database.php";
?>

<html lang="en"> <!-- Language is specified to increase SEO. -->

    <head> <!-- Content invisible to the user -->
        <title>Cart - UCLan Student's Union Shop</title> <!-- Sets the name of the tab in the browser -->
        <meta name="viewport" content="width=device-width, initial-scale=1"> <!-- Enable media queries & define charset -->
        <meta charset="utf-8">
        <link type="text/css" rel="stylesheet" href="../bootstrap.min.css"> <!-- The Bootstrap version 5 stylesheet -->
        <link type="text/css" rel="stylesheet" href="../style.css">
        <script src="../Scripts/Client/UserAccountRequest.js"></script> <!-- Ajax is used to communicate between the client and the server -->
        <script src="../Scripts/Client/Navigation.js"></script> <!-- Used to configure the hamburger menu -->
        <script src="../Scripts/Client/manageCart.js"></script> <!-- Load all products in the localStorage -->
        <script src="../Scripts/Client/bootstrap.bundle.min.js"></script> <!-- The Bootstrap version 5 latest scripts -->
    </head>

    <body> <!-- Content in the body is visible to the user -->
        <div id="content">
            <div id="header"> <!-- Defines the top of the page, visible on all pages -->
                <a href="index.php"> <!-- Allows the UCLan logo to act as a button -->
                    <img id="uclan_logo" src="../Images/uclan_logo.png" alt="University of Central Lancashire Logo">
                </a>
                <h2 id="title">Student Shop</h2>
                <input type="image" id="hamburger_menu" src="../Images/HamburgerMenu.svg" onclick="onMenuMouseDown()" alt="Menu toggle">
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

            <div id="main">
                <h2 class="title">Shopping Cart</h2>
                <?php
                    if (isset($_SESSION["name"])) 
                    {
                        echo '<p>Welcome, ' . $_SESSION["name"] . '! You have added the following items to your cart:</p>';
                    }
                    else
                    {
                        echo '<p>The list below shows what you have added to your shopping cart.</p>';
                    }
                ?>
                <br>
                <div id="table"> <!-- A table is used to show the items in the cart. -->
                    <div class="table_row"> <!-- A "row" class is used on each item, and in this case, the headers of the table -->
                        <strong>Item ID</strong>
                        <strong>Image</strong>
                        <strong>Product Name</strong>
                        <strong>Price</strong>
                        <strong>Remove</strong> <!-- Remove buttons will be available for each item in the cart -->
                    </div>
                    <hr>
                </div>
                <hr>
                <?php
                    if (isset($_SESSION["name"])) // Create a checkout button if the user is logged in
                    {
                        echo '<button id="checkout" onclick="performCheckout()">Checkout</button>';
                        // Show the user their previous orders if there is a user available
                        echo '<h2 class="title">Previous Orders</h2>';
                        echo '<p>The orders you have made previously are displayed below:</p>';
                        $previous_order_statement = prepare_statement(
                            "SELECT * FROM orders WHERE user_id = ?;",
                            array("i", $_SESSION["id"])
                        );
                        echo '<div id="table" class="orders">';
                        echo '<div class="table_row">';
                        echo '<strong>Order Number</strong>';
                        echo '<strong>Order Date</strong>';
                        echo '<strong>Image</strong>';
                        echo '<strong>Product Name</strong>';
                        echo '<strong>Price</strong>';
                        echo '</div><hr>';
                        if ($previous_order_statement->num_rows < 1)
                        {
                            echo '<p>You have not made any orders!</p>';
                        }
                        else
                        {
                            while ($result = $previous_order_statement->fetch_assoc())
                            {
                                $product_ids = explode(" ", $result["product_ids"]);
                                for ($index = 0; $index < count($product_ids); $index++)
                                {
                                    $product_info_statement = prepare_statement(
                                        "SELECT product_type, colour, product_image, price FROM products INNER JOIN productTypes ON products.product_type = productTypes.productType AND products.product_id = ?",
                                        array("i", $product_ids[$index])
                                    );
                                    $product_info = $product_info_statement->fetch_assoc();
                                    echo '<div class="table_row order_row">';
                                    echo '<p>' . $result["order_id"] . '</p>';
                                    echo '<p>' . $result["order_date"] . '</p>';
                                    echo '<img src="' . $product_info["product_image"] . '">';
                                    echo '<p>' . $product_info["colour"] . " " . $product_info["product_type"] . '</p>';
                                    echo '<p>' . $product_info["price"] . '</p>';
                                    echo '</div>';
                                }
                            }
                        }
                        echo '</div>';
                    }
                    else
                    {
                        echo '<p>You must <a href="login.php">Log in</a> in order to make a purchase.</p>';
                    }
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
                <p>Email: <a href="mailto:suinformation@uclan.ac.uk">suinformation@uclan.ac.uk</a></p>
                <p>Phone: <a href="tel:01772893000">01772 893000</a></p>
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