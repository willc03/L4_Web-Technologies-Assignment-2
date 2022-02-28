<!--
    Author: Will Corkill
    Name: products.html
    Last Accessed: 13/01/2022
    Description: The page displaying all of the products to the user.
-->
<!DOCTYPE html>

<?php
    session_start();
    require '../Scripts/Server/Database.php';
    // Check if a review is submitted
    if (isset($_POST['review_title']) and isset($_SERVER['REQUEST_URI']) and isset($_SESSION["name"]))
    {
        // Connect to the database
        $dbConnection = database_connect();
        $next_review_key = get_next_primary_key("reviews");
        // Get formatted time
        $date_time = new DateTime();
        $current_time = $date_time->format('Y-m-d H:i:s');
        // Add the new review
        $addNewReview = prepare_statement(
            "INSERT INTO reviews (review_id, user_id, product_id, review_title, review_desc, review_rating, review_timestamp) VALUES (?, ?, ?, ?, ?, ?, ?)",
            array("iiissis", $next_review_key, $_SESSION["id"], $_POST["product_id"], $_POST["review_title"], $_POST["review_description"], $_POST["rating"], $current_time)
        );
        // Prevent the resubmit request on forms when refreshing the page
        if ($addNewReview)
        {
            header("Location: " . $_SERVER["REQUEST_URI"] . "?review_success=true");
        }
        else
        {
            header("Location: " . $_SERVER["REQUEST_URI"] . "?review_success=false");
        }
        // Relinqish the database connection
        $dbConnection->close();
        exit();
    }
?>

<html lang="en"> <!-- Language is specified to increase SEO. -->
    <head> <!-- Content invisible to the user -->
        <title>Products - UCLan Student's Union Shop</title> <!-- Sets the name of the tab in the browser -->
        <meta name="viewport" content="width=device-width, initial-scale=1"> <!-- Enable media queries & define charset -->
        <meta charset="utf-8">
        <link type="text/css" rel="stylesheet" href="../bootstrap.min.css"> <!-- The Bootstrap version 5 stylesheet -->
        <link type="text/css" rel="stylesheet" href="../style.css">
        <script src="../Scripts/Client/Navigation.js"></script> <!-- Used to configure the hamburger menu -->
        <script src="../Scripts/Client/UserAccountRequest.js"></script> <!-- Ajax is used to communicate between the client and the server -->
        <script src="../Scripts/Client/manageCart.js"></script> <!-- This script provides local functions for managing the cart -->
        <script src="../Scripts/Client/bootstrap.bundle.min.js"></script> <!-- The Bootstrap version 5 latest scripts -->
    </head> 
    <body> <!-- Content in the body is visible to the user -->
        <div id="content">
            <div id="header"> <!-- Defines the top of the page, visible on all pages -->
                <a href="index.php"> <!-- Allows the UCLan logo to act as a button (Nikitha, 2018) -->
                    <img id="uclan_logo" src="../Images/uclan_logo.png" alt="University of Central Lancashire Logo">
                </a>
                <h2 id="title">Student Shop</h2>
                <input type="image" id="hamburger_menu" src="../Images/HamburgerMenu.svg" onclick="onMenuMouseDown()" alt="Menu toggle"> <!-- Create the hamburger menu for mobile-sized devices with click event (w3schools, n.d. b) -->
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
                <br>
                <?php
                    if (isset($_GET["review_success"]))
                    {
                        echo '<div id="review_state" class="' . $_GET["review_success"] . '">';
                        if ($_GET["review_success"] == "true")
                        {
                            echo '<h2><strong>Review submitted successfully</strong></h2>';
                            echo '<p>Your product review has been successfully submitted, thank you!</p>';
                        }
                        else
                        {
                            echo '<h2><strong>Review couldn\'t be submitted</strong></h2>';
                            echo '<p>There was an error submitting your review, please try again.</p>';
                        }
                        echo '</div>';
                    }
                ?>
                <div id="productFilters">
                    <form method="get" id="filterSettings"> <!-- No action is provided as the form leads to the same page -->
                        <div id="filterSearch">
                            <input type="search" name="productSearch" id="searchBox">
                            <input type="submit" value="Search" id="submitFilters">
                        </div>
                        <br>
                         <!-- These buttons will be used to provide filters to only show certain products-->
                        <div id="filterButtons">
                            <?php // Buttons to filter products will be added dynamically in the case of further product types in future.
                                // Make all button
                                $hasProductFilter = isset($_GET["productFilter"]);
                                $hasSearchFilter = isset($_GET["productSearch"]);
                                if (($hasProductFilter and $_GET["productFilter"] == "All") or (!$hasProductFilter and !$hasSearchFilter) or (!$hasProductFilter and ($hasSearchFilter and in_array($_GET["productSearch"], array("", " ")) )))
                                {
                                    echo '<input type="submit" name="productFilter" value="All" class="active_category">';
                                }
                                else
                                {
                                    echo '<input type="submit" name="productFilter" value="All" class="categoryFilter">';
                                }
                                // Connect to the database
                                $dbConnection = database_connect();
                                $select_product_types = "SELECT productType FROM productTypes";
                                $product_types = $dbConnection->query($select_product_types);
                                // Check there are results
                                if ($product_types and $product_types->num_rows > 0)
                                {
                                    while ($product_type = $product_types->fetch_row())
                                    {
                                        echo '<input type="submit" name="productFilter" value="' . $product_type[0] . '" class="' . ((isset($_GET["productFilter"]) and $product_type[0] == $_GET["productFilter"]) ? 'active_category' : 'categoryFilter') . '">';
                                    }
                                }
                                $dbConnection->close();
                            ?>
                        </div>
                    </form>
                </div>
                <div id="products">
                <?php
                    // Retrieve a database connection
                    $dbConnection = database_connect();
                    // Select the products
                    if (isset($_GET["productFilter"]) and $_GET["productFilter"] != "All")
                    {
                        // If a filter button has been used
                        $select_products = prepare_statement(
                            "SELECT products.*, productTypes.productTypeDescription, productTypes.price FROM products INNER JOIN productTypes ON products.product_type = productTypes.productType AND products.product_type = ?;",
                            array('s', $_GET["productFilter"])
                        );
                    }
                    else if (isset($_GET["productSearch"]) and !in_array($_GET["productSearch"], array("", " ")))
                    {
                        // If the product has been searched for
                        $product_search = '%' . $_GET["productSearch"] . '%';
                        $select_products = prepare_statement(
                            "SELECT products.*, productTypes.productTypeDescription, productTypes.price FROM products INNER JOIN productTypes ON products.product_type = productTypes.productType WHERE (products.colour LIKE ? OR products.product_type LIKE ?);",
                            array('ss', $product_search, $product_search)
                        );
                    }
                    else
                    {
                        // If there is no form submission
                        $sql_select_products = "SELECT products.*, productTypes.productTypeDescription, productTypes.price FROM products INNER JOIN productTypes ON products.product_type = productTypes.productType;";
                        $select_products = $dbConnection->query($sql_select_products);
                    }
                    // Add the products to the display
                    //if ($select_products and $select_products->num_rows > 0)
                    //{
                        while ($product = $select_products->fetch_assoc())
                        {
                            // Start container
                            echo '<div class="product_container">';
                            // Display the results to the user.
                            echo '<img src="' . $product["product_image"] . '">';
                            echo '<h2 class="sub_title">' . $product["colour"] . '</h2>';
                            echo '<h2 class="sub_title">' . $product["product_type"] . '</h2>';
                            echo '<p class="product_description">' . $product["productTypeDescription"] . '</p>';
                            // A small form will be used to redirect the user when they press read more
                            echo '<form action="item.php" method="get">';
                            echo '<input type="hidden" name="product_id" id="product_id" value="' . $product["product_id"] . '">';
                            echo '<input type="hidden" name="title" id="title" value="' . $product["colour"] . ' ' . $product["product_type"] . '">';
                            echo '<input class="new_line read_more" type="submit" value="Read more...">';
                            echo '</form>'; // End form
                            echo '<strong class="product_price new_line"> £' . $product["price"] . '</strong>';
                            // Create buy button
                            echo '<input type="button" class="purchase_button" value="Buy" ontouchend="addToCart(\'' . $product["product_type"] . '\', \'' . $product["colour"] . '\', ' . $product["product_id"] .')" onclick="addToCart(\'' . $product["product_type"] . '\', \'' . $product["colour"] . '\', ' . $product["product_id"] .')">';
                            // End container
                            echo '</div>';
                        }
                    //}
                    $dbConnection->close();
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