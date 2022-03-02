<?php
    // Start the session and get database functions
    session_start();
    require '../Server/Database.php';
    // Run a secured statement
    $next_order_id = get_next_primary_key("orders");
    $prepare_checkout_statement = prepare_statement(
        "INSERT INTO orders (order_id, user_id, product_ids) VALUES (?, ?, ?);",
        array("iis", $next_order_id, $_SESSION["id"], $_POST["orderItems"])
    );
    // Check success
    if ($prepare_checkout_statement != "failed")
    {
        echo "success";
    }
    else
    {
        echo "fail";
    }
?>