<?php
    session_start();
    if ($_POST["currentState"] == "Sign in")
    {
        echo "LoginRedirect";
    }
    else
    {
        session_destroy();
        echo "Sign in";
    }
?>