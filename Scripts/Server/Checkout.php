<?php
    session_start();
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

    $dbConnection = getDatabaseConnection();

    $prepareCheckoutStatement = $dbConnection->prepare("INSERT INTO orders (order_id, user_id, product_ids) VALUES (?, ?, ?);");
    $prepareCheckoutStatement->bind_param('iis', $order_id, $_SESSION["id"], ($_POST["orderItems"]));

    //$dateTime = new DateTime();
    //$order_date = $dateTime->format('Y-m-d H:i:s');

    $sqlGetNextOrderId = "SELECT auto_increment FROM INFORMATION_SCHEMA.TABLES WHERE table_name = 'orders';";
    $order_id = ($dbConnection->query($sqlGetNextOrderId))->fetch_row()[0]; // Get the next value

    if ($prepareCheckoutStatement->execute())
    {
        echo "success";
    }
    else
    {
        echo "fail";
    }
?>