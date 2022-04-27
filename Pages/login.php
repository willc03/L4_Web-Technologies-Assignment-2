<!--
    Author: Will Corkill
    Name: login.php
    Description: The user can log in and sign up using this page.
-->
<!DOCTYPE html>

<?php
    session_start(); // Allow the page to make use of the $_SESSION variable
    require '../Scripts/Server/Database.php';
    if (isset($_SESSION["id"])) // Send user back to the home page if they are already logged in
    {
        header("Location: ./index.php");
        exit();
    }
    if (isset($_POST["submit_type"]) and $_POST["submit_type"] == "Log in") // Check if the user has pressed log in to process their details
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
        if ($user_result->num_rows == 0)
        {
            $doesEmailExist = false;
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
    if (isset($_POST["submit_type"]) and $_POST["submit_type"] == "Sign Up")
    {
        // Get form details
        $email = $_POST["email"];
        // Execute an inject-protected statement
        $get_existing_user_details = prepare_statement(
            "SELECT COUNT(user_id) FROM users WHERE user_email = ?;",
            array("s", $email)
        );
        // Check if the email already exists in the system
        $existing_row = $get_existing_user_details->fetch_row();
        if ($existing_row[0] > 0)
        {
            $emailAlreadyExists = true;
        }
        else
        {
            // Add the user's information to the system
            $next_user_id = get_next_primary_key("users");
            // Insert user info into the database
            $date_time = new DateTime();
            $formatted_time = $date_time->format("Y-m-d H:i:s");
            // Prepare statement
            $create_new_details = prepare_statement(
                "INSERT INTO users (user_id, user_full_name, user_address, user_email, user_pass, user_timestamp) VALUES (?, ?, ?, ?, ?, ?)",
                array("isssss", $next_user_id, $_POST["fullName"], $_POST["address"], $_POST["email"], password_hash($_POST["password"], PASSWORD_BCRYPT), $formatted_time) // PASSWORD_BCRYPT is a constant
            );
            $new_account = true;
        }
    }
?>

<html lang="en"> <!-- Language is specified to increase SEO. -->

    <head> <!-- Content in the head of the document invisible to the user -->
        <title>Login - UCLan Student's Union Shop</title> <!-- Sets the name of the tab in the browser -->
        <meta name="viewport" content="width=device-width, initial-scale=1"> <!-- Enable media queries & define charset -->
        <meta charset="utf-8">
        <link type="text/css" rel="stylesheet" href="../bootstrap.min.css"> <!-- The Bootstrap version 5 stylesheet -->
        <link type="text/css" rel="stylesheet" href="../style.css">
        <script src="../Scripts/Client/Navigation.js"></script> <!-- Used to configure the hamburger menu -->
        <script src="../Scripts/Client/formValidation.js"></script> <!-- Used to locally validate forms -->
        <script src="../Scripts/Client/UserAccountRequest.js"></script> <!-- Ajax is used to communicate between the client and the server -->
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
            
            <div id="main"> <!-- Defines the main content of the page, below the header, above the footer. -->
                <?php
                    if ((!isset($new_account)) and (isset($_POST["submit_type"]) and in_array($_POST["submit_type"], array("Sign up here", "Sign Up")))) // If the user has pressed sign up
                    {
                        echo '<br><h2 class="sub_title">Sign Up</h2><br>';
                        if (isset($emailAlreadyExists)) // Present an error message if the email already belongs to an account
                        {
                            echo '<div id="incorrect_details">';
                            echo '<h2><strong>Email in use</strong></h2>';
                            echo '<p>The email entered is already registered to an account on our website. Please try again.</p>';
                            echo '</div>';
                        }
                        echo '<form method="post" id="sign_up_form">';
                        echo '<label for="fullName">Full name: </label><br>';
                        echo '<input type="text" name="fullName" required><br>';

                        echo '<label for="email">Email: </label><br>';
                        echo '<input type="email" name="email" required><br>';

                        echo '<label for="address">Address: </label><br>';
                        echo '<input type="text" name="address" required>';

                        echo '<div id="password_container">';

                        echo '<br><label for="password">Password: </label>';
                        // Following password section from w3schools (n.d. b)
                        echo '<input type="password" name="password" id="password" minlength="8" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" required>';

                        echo '<ul id="password_requirements">';
                        echo '<p class="requirements">Password requirements:</p><br>';
                        echo '<li class="invalid" id="length">Contain at least 8 characters</li>';
                        echo '<li class="invalid" id="uppercase">Contain at least 1 upper-case character</li>';
                        echo '<li class="invalid" id="lowercase">Contain at least 1 lower-case character</li>';
                        echo '<li class="invalid" id="number">Contain at least 1 number</li>';
                        echo '</ul><br>';

                        echo '<label for="confirmPassword">Confirm password: </label><br>';
                        echo '<input type="password" name="confirmPassword" id="confirmPassword" required>';

                        echo '</div><br>';
                        echo '<input type="submit" value="Sign Up" name="submit_type">';
                        echo '</form>';
                    }
                    else // If the user has loaded the page for the first time or has pressed log in
                    {
                        echo '<h2 class="title">Log in</h2>';
                        echo '<p>Logging into our website will allow you to order items at the checkout.</p>';
                        if (isset($new_account))
                        {
                            echo '<div id="new_account">';
                            echo '<h2><strong>Account Created</strong></h2>';
                            echo '<p>Your account has been successfully created. Please log in using the form below.</p>';
                            echo '</div>';
                        }
                        else if (isset($_POST["submit_type"])) // Add necessary feedback for incorrect details.
                        {
                            echo '<div id="incorrect_details">';
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
                        echo '<form method="post" id="log_in_form">';
                        echo '<label for="loginEmail">Email: </label><br>';
                        echo '<input type="email" name="loginEmail" required><br>';
                        echo '<label for="loginPassword">Password: </label><br>';
                        echo '<input type="password" name="loginPassword" required>';
                        echo '<br><br><input type="submit" name="submit_type" value="Log in" id="loginButton"><br>';
                        echo '<label for="signUp">Don\'t have an account?</label>';
                        echo '</form>';
                        echo '<form method="post" id="log_in_form">';
                        echo '<input type="submit" name="submit_type" value="Sign up here" id="signUpButton">';
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