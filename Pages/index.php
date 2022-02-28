<!--
    Author: Will Corkill
    Name: index.php
    Last Accessed: 25/02/2022
    Description: The first page the user will see on the website.
-->
<!DOCTYPE html>

<?php
    session_start(); // A session is needed to get and store information about the user
    require '../Scripts/Server/Database.php'; // Provides useful database functions
?>

<html lang="en"> <!-- Language is specified to increase SEO. -->
    <head> <!-- Content in the head of the document invisible to the user -->
        <title>Home - UCLan Student's Union Shop</title> <!-- Sets the name of the tab in the browser -->
        <meta name="viewport" content="width=device-width, initial-scale=1"> <!-- Enable media queries & define charset -->
        <meta charset="utf-8">
        <link type="text/css" rel="stylesheet" href="../bootstrap.min.css"> <!-- The Bootstrap version 5 stylesheet -->
        <link type="text/css" rel="stylesheet" href="../style.css"> <!-- A unique CSS file for this page exclusively -->
        <script src="../Scripts/Client/Navigation.js"></script> <!-- Used to configure the hamburger menu -->
        <script src="../Scripts/Client/UserAccountRequest.js"></script> <!-- Ajax is used to communicate between the client and the server -->
        <script src="../Scripts/Client/bootstrap.bundle.min.js"></script> <!-- The Bootstrap version 5 latest scripts -->
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
            
            <div id="main"> <!-- Defines the main content of the page, below the header, above the footer. -->
                <div class="offer_container">
                    <h2 class="title">Offers</h2>
                    <div id="offer_slides" class="carousel carousel-dark slide carousel-fade" data-bs-ride="carousel">
                        <!-- The code in this section is a piece of Bootstrap code which provides a mini slideshow presenting the offers -->
                        <div class="carousel-inner">
                            <?php
                                // Activate the connection to the database
                                $dbConnection = database_connect();
                                // Create a query to obtain offers
                                $selectOffers = "SELECT * FROM offers;";
                                $sqlResult = $dbConnection->query($selectOffers);
                                // Check the query was successful
                                if ($sqlResult->num_rows > 0)
                                {
                                    $isFirstIteration = true;
                                    // Create a carousel item for each offer
                                    while ($offer = $sqlResult->fetch_assoc())
                                    {
                                        // Opening div tag for the carousel
                                        echo '<div class="carousel-item' . ($isFirstIteration ? ' active' : '') . '">';
                                        // Offer content
                                        echo '<div class="offer">';
                                        echo '<h2 class="sub_title">' . $offer["offer_title"] . '</h2>';
                                        echo '<p>' . $offer["offer_description"] . "</p>";
                                        echo '</div>';
                                        // Closing div tag for carousel.
                                        echo '</div>';
                                        $isFirstIteration = false;
                                    }
                                }
                                // Close the connection to the database
                                $dbConnection->close();
                            ?>
                        </div>

                        <!-- Left and right controls/icons -->
                        <button class="carousel-control-prev" type="button" data-bs-target="#offer_slides" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon"></span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#offer_slides" data-bs-slide="next">
                            <span class="carousel-control-next-icon"></span>
                        </button>
                    </div>
                </div>
                <div class="introduction"> <!-- The introduction contains all text on the index page -->
                    <h2 class="title">Where opportunity creates success</h2> <!-- The h1 heading is used here as the main heading for the page -->
                    <p>Every student at The University of Central Lancashire is automatically a member of the Students' Union. We're here to make life better for students - inspiring you to succeed and achieve your goals.</p>
                    <p>Everything you need to know about UCLan Students' Union. Your membership starts here.</p>
                </div>
                <h2 class="sub_title">Together</h2>
                <div class="video_container">
                    <video class="video_content" controls> <!-- The source tags are used for browsers which may not support the use of mp4 or ogg files, so can choose between them -->
                        <source src="../UCLan%20Together.mp4" type="video/mp4">
                        <source src="../UCLan%20Together.ogg" type="video/ogg">
                    </video>
                </div>
                <h2 class="sub_title">Join our global community</h2>
                <div class="video_container"> <!-- A container is used to manage the size on different devices. -->
                    <iframe src="https://www.youtube.com/embed/i2CRunZv9CU" title="UCLan Student's Union Video" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" class="video_content"></iframe>
                </div>
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