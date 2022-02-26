<!--
    Author: Will Corkill
    Name: login.php
    Last Accessed: 25/02/2022
    Description: The user can log in and sign up using this page.
-->
<!DOCTYPE html>

<?php
    session_start(); // Allow the page to make use of the $_SESSION variable
    require '../Scripts/Server/Database.php';
    if (isset($_POST["submitType"]) and $_POST["submitType"] == "Log in") // Check if the user has pressed log in
    {
        // Get the information from the form
        $email = $_POST["loginEmail"];
        $password = $_POST["loginPassword"];
        // Use the database functions to write an injection-protected statement
        $user_result = prepare_statement(
            "SELECT user_id, user_full_name, user_pass FROM users WHERE user_email = ?;",
            array("s", $email)
        );
        // Check if user details exist and if they do, get user details
        if (!$user_result->num_rows > 0)
        {
            $doesEmailExist = false;
            exit();
        }
        else
        {
            $user_details = $user_result->fetch_assoc();
            $user_hashed_password = $user_details["user_pass"];
            // Check the user's password
            if (password_verify($password, $user_hashed_password) == true)
            {
                // Set session details and redirect
                $_SESSION["id"] = $user_details["user_id"];
                $_SESSION["name"] = $user_details["user_full_name"];
                header("Location: ./index.php");
                exit();
            }
        }
    }
    if (isset($_POST["submitType"]) and $_POST["submitType"] == "Sign Up")
    {
        // Get form details
        $email = $_POST["email"];
        // Execute an inject-protected statement
        $create_user_details = prepare_statement(
            "SELECT COUNT(user_id) FROM users WHERE user_email = ?;",
            array("s", $email)
        )
        // Check if the email already exists in the system
        if ($create_user_details->num_rows > 0)
        {
            $emailAlreadyExists = true;
            exit();
        }
        else
        {
            $next_user_id = get_next_primary_key("users");
            // Insert user info into the database
            $date_time = new DateTime();
            $formatted_time = $date_time->format("Y-m-d H:i:s");
            // Prepare statement
            $sql_insert_data = prepare_statement(
                "INSERT INTO users (user_id, user_full_name, user_address, user_email, user_pass, user_timestamp) VALUES (?, ?, ?, ?, ?, ?)",
                array("isssss", $next_user_id, $_POST["fullName"], $_POST["address"], $_POST["email"], password_hash($_POST["password"], PASSWORD_BCRYPT), $formatted_time)
            )
            $newAccount = true;
        }
    }
?>

<html lang="en"> <!-- Language is specified to increase SEO. -->

    <head> <!-- Content in the head of the document invisible to the user -->
        <title>Login - UCLan Student's Union Shop</title> <!-- Sets the name of the tab in the browser -->
        <link type="text/css" rel="stylesheet" href="../Stylesheets/bootstrap.min.css"> <!-- The Bootstrap version 5 stylesheet -->
        <link type="text/css" rel="stylesheet" href="../Stylesheets/global.css"> <!-- Style the header & footer of the page -->
        <link type="text/css" rel="stylesheet" href="../Stylesheets/index.css"> <!-- The index sheet is used as the characteristics are similar to what is needed
        <meta name="viewport" content="width=device-width, initial-scale=1"> <!-- Enable media queries & define charset -->
        <meta charset="utf-8">
        <script src="../Scripts/navigation.js"></script> <!-- Used to configure the hamburger menu -->
        <script src="../Scripts/formValidation.js"></script> <!-- Used to locally validate forms -->
        <script src="../Scripts/ajaxRequests.js"></script> <!-- Ajax is used to communicate between the client and the server -->
        <script src="../Scripts/bootstrap.bundle.min.js"></script> <!-- The Bootstrap version 5 latest scripts -->
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
                <?php
                    if ((!isset($newAccount)) and (isset($_POST["submitType"]) and in_array($_POST["submitType"], array("Sign up here", "Sign Up")))) // If the user has pressed sign up
                    {
                        echo '<br><h2 class="sub_title">Sign Up</h2><br>';
                        if (isset($emailAlreadyExists))
                        {
                            echo '<div id="incorrectDetails">';
                            echo '<h2><strong>Email in use</strong></h2>';
                            echo '<p>The email entered is already registered to an account on our website. Please try again.</p>';
                            echo '</div>';
                        }
                        echo '<form method="post" id="signup">';
                        echo '<label for="fullName">Full name: </label><br>';
                        echo '<input type="text" name="fullName" required><br>';

                        echo '<label for="email">Email: </label><br>';
                        echo '<input type="email" name="email" required><br>';

                        echo '<label for="address">Address: </label><br>';
                        echo '<input type="text" name="address" required>';

                        echo '<div id="passwordContainer">';

                        echo '<br><label for="password">Password: </label>';
                        echo '<input type="password" name="password" id="password" minlength="8" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" required>';

                        echo '<ul id="passwordRequirements">';
                        echo '<p class="requirements">Password requirements:</p><br>';
                        echo '<li class="invalid" id="length">Contain at least 8 characters</li>';
                        echo '<li class="invalid" id="uppercase">Contain at least 1 upper-case character</li>';
                        echo '<li class="invalid" id="lowercase">Contain at least 1 lower-case character</li>';
                        echo '<li class="invalid" id="number">Contain at least 1 number</li>';
                        echo '</ul><br>';

                        echo '<label for="confirmPassword">Confirm password: </label><br>';
                        echo '<input type="password" name="confirmPassword" id="confirmPassword" required>';

                        echo '</div><br>';
                        echo '<input type="submit" value="Sign Up" name="submitType">';
                        echo '</form>';
                    }
                    else // If the user has loaded the page for the first time or has pressed log in
                    {
                        echo '<h1 class="title">Log in</h1>';
                        echo '<p>Logging into our website will allow you to order items at the checkout.</p>';
                        if (isset($newAccount))
                        {
                            echo '<div id="newAccount">';
                            echo '<h2><strong>Account Created</strong></h2>';
                            echo '<p>Your account has been successfully created. Please log in using the form below.</p>';
                            echo '</div>';
                        }
                        else if (isset($_POST["submitType"])) // Add necessary feedback for incorrect details.
                        {
                            echo '<div id="incorrectDetails">';
                            if (isset($doesEmailExist) and !$doesEmailExist) // This variable was created in the first section of PHP
                            {
                                echo '<h2><strong>Invalid Email</strong></h2>';
                                echo '<p>The email you have entered could not be found. Please try re-entering your email or signing up for an account.</p>';
                            }
                            else // The only other possible piece of information the user can get wrong is the password
                            {
                                echo '<h2><strong>Invalid Password</strong></h2>';
                                echo '<p>The password you have entered is incorrect, please try again.</p>';
                            }
                            echo '</div>';
                        }
                        echo '<form method="post" class="loginForm">';
                        echo '<label for="loginEmail">Email: </label><br>';
                        echo '<input type="email" name="loginEmail" required><br>';
                        echo '<label for="loginPassword">Password: </label><br>';
                        echo '<input type="password" name="loginPassword" required>';
                        echo '<br><br><input type="submit" name="submitType" value="Log in" id="loginButton"><br>';
                        echo '<label for="signUp">Don\'t have an account?</label>';
                        echo '</form>';
                        echo '<form method="post" class="loginForm">';
                        echo '<input type="submit" name="submitType" value="Sign up here" id="signUpButton">';
                        echo '</form>';
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