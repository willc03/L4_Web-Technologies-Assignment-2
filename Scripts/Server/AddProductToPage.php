<?php
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
    $prepareProductStatement = $dbConnection->prepare(
        "SELECT products.product_id, products.colour, products.product_image, products.product_type, productTypes.price
        FROM products 
        INNER JOIN productTypes
        ON productTypes.productType = products.product_type
        AND products.product_id = ?;"
    );
    $prepareProductStatement->bind_param('s', $_POST["product_id"]);
    $prepareProductStatement->execute();
    $result = $prepareProductStatement->get_result();
    $data_row = $result->fetch_assoc();
    echo '<div class="table_row" id="' . $data_row["product_type"] . $data_row["colour"] . '">';
    echo '<p>' . $data_row["product_id"] . '</p>';
    echo '<img src=\'' . $data_row["product_image"] . '\'>';
    echo '<p>' . $data_row["colour"] . ' ' . $data_row["product_type"] . '</p>';
    echo '<p>£' . $data_row["price"] . '</p>';
    echo '<button onclick="removeFromCart(\'' . $data_row["product_type"] . $data_row["colour"] . '\', \'' . $_POST["localStorageKey"] . '\')">Remove</button>';
    echo '</div>';
?>