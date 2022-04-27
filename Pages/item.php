<!--
    Author: Will Corkill
    Name: item.php
    Last Accessed: 26/02/2022
    Description: The page which will display a specific item. Only accessible via clicking on an item.
-->
<!DOCTYPE html>

<?php
    session_start();
    require '../Scripts/Server/Database.php';
    // If the user has tried to access this page without selecting a product, they will be redirected to another page
    if (!isset($_GET["product_id"]))
    {
        header("Location: ./products.php"); // Send the user back to the products page.
        exit(); // End this PHP script
    }
    // Ratings will be used when displaying reviews
    $ratings = array("Awful", "Poor", "Average", "Good", "Excellent");
?>

<html lang="en"> <!-- Language is specified to increase SEO. -->

    <head> <!-- Content invisible to the user -->
        <title><?php echo $_GET["title"] . " - UCLan Student's Union Shop"; ?></title> <!-- PHP will be used to edit the name of the tab -->
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

            <div id="main"> <!-- The DOM will be manipulated to display content in this container. -->
                <?php
                    // Get the database connection
                    $dbConnection = database_connect();
                    // Prepare get statement
                    $get_product_info = prepare_statement(
                        "SELECT products.product_id, products.colour, products.product_type, products.product_image, productTypes.price, productTypes.productTypeDescription FROM products INNER JOIN productTypes ON products.product_type = productTypes.productType AND product_id = ?;",
                        array("i", $_GET["product_id"])
                    );
                    $product_info = $get_product_info->fetch_assoc();
                    // Generate the product container
                    echo '<div class="product_container large">'; // Display the results to the user.
                    echo '<img src="' . $product_info["product_image"] . '">';
                    echo '<h2 class="sub_title">' . $product_info["colour"] . '</h2>';
                    echo '<h2 class="sub_title">' . $product_info["product_type"] . '</h2>';
                    echo '<p class="product_description">' . $product_info["productTypeDescription"] . '</p>';
                    echo '<strong class="product_price"> £' . $product_info["price"] . '</strong>';
                    // Create buy button
                    echo '<input type="button" class="purchase_button" value="Buy" onclick="addToCart(\'' . $product_info["product_type"] . '\', \'' . $product_info["colour"] . '\', ' . $product_info["product_id"] .')" ontouchend="addToCart(\'' . $product_info["product_type"] . '\', \'' . $product_info["colour"] . '\', ' . $product_info["product_id"] . '\')">';
                    // End container
                    echo '</div>';
                    // Close the database connection
                    $dbConnection->close();
                ?>
            </div>
            <div id="reviews">
                <h2><strong>Reviews</strong></h2>
                <?php
                    $dbConnection = database_connect();
                    // Get review count
                    $get_review_info = prepare_statement(
                        "SELECT COUNT(review_id), SUM(review_rating)/COUNT(review_id) FROM reviews WHERE product_id = ?;",
                        array("i", $product_info["product_id"])
                    );
                    // Get data
                    $data_row = $get_review_info->fetch_row();
                    $review_count = $data_row[0];
                    //
                    if ($review_count == 0)
                    {
                        echo '<p>There are no reviews for this product!</p>';
                    }
                    else
                    {
                        // Display average product rating
                        $average_rating = $data_row[1];
                        echo '<h2>Average product rating: ' . round($average_rating, 2) . '</h2>';
                        // Get content of reviews
                        $get_reviews = prepare_statement(
                            "SELECT review_title, review_desc, review_rating FROM reviews WHERE product_id = ?;",
                            array("i", $product_info["product_id"])
                        );
                        echo '<div id="user_reviews">';
                        // Display the reviews
                        while ($review_content = $get_reviews->fetch_assoc())
                        {
                            echo '<div class="review_container">';
                            echo '<h3>' . $review_content["review_title"] . '</h3>';
                            echo '<p class="review_rating">' . $ratings[$review_content["review_rating"]-1] . ' (' . $review_content["review_rating"] . '/5)</p>';
                            echo '<p class="review_description">' . $review_content["review_desc"] . '</p>';
                            echo '</div>';
                        }
                        echo '</div>';
                    }
                    // Allow users to submit reviews if logged in
                    echo '<hr><h2><strong>Write a review</strong></h2>';
                    if (isset($_SESSION["name"]))
                    {
                        echo '<form method="post" id="write_review" action="products.php">'; // Post is used so the content does not flood the URL
                        echo '<label for="review_title"><strong>Title:</strong></label><br>';
                        echo '<input type="text" name="review_title" maxlength="255" required>';
                        echo '<br><br><label><strong>Rating:</strong></label><br>';
                        // Add rating buttons
                        echo '<input type="radio" name="rating" value="5" required>';
                        echo '<label>Excellent</label><br>';
                        echo '<input type="radio" name="rating" value="4">';
                        echo '<label>Good</label><br>';
                        echo '<input type="radio" name="rating" value="3">';
                        echo '<label>Average</label><br>';
                        echo '<input type="radio" name="rating" value="2">';
                        echo '<label>Poor</label><br>';
                        echo '<input type="radio" name="rating" value="1">';
                        echo '<label>Awful</label><br><br>';
                        // Add the description box
                        echo '<label for="review_description"><strong>Description:</strong></label><br>';
                        echo '<input type="text" name="review_description" required><br><br>';
                        // Add a hidden input which contains the product id for later use when adding to the database
                        echo '<input type="hidden" name="product_id" value="' . $_GET["product_id"] . '">';
                        // Submit the review using a button
                        echo '<input type="submit" value="Submit review">';
                        echo '</form>';
                    }
                    else
                    {
                        // If the user is not logged in, they will have to log in before they can submit a review
                        echo "<p>Log in <a href='login.php'>here</a> to submit a review.</p>";
                    }
                    // Close the database connection
                    $dbConnection->close();
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