<?php
    // Ajax request information from w3schools (n.d. a)
    // Get useful database function
    require '../Server/Database.php';
    // Connect to the database
    $prepare_product_statement = prepare_statement(
        "SELECT products.*, productTypes.price FROM products INNER JOIN productTypes ON productTypes.productType = products.product_type AND products.product_id = ?;",
        array("s", $_POST["product_id"])
    );
    $data_row = $prepare_product_statement->fetch_assoc();
    echo '<div class="table_row" id="' . $data_row["product_type"] . $data_row["colour"] . '">';
    echo '<p>' . $data_row["product_id"] . '</p>';
    echo '<img src=\'' . $data_row["product_image"] . '\'>';
    echo '<p>' . $data_row["colour"] . ' ' . $data_row["product_type"] . '</p>';
    echo '<p>£' . $data_row["price"] . '</p>';
    echo '<button onclick="removeFromCart(\'' . $data_row["product_type"] . $data_row["colour"] . '\', \'' . $_POST["localStorageKey"] . '\')">Remove</button>';
    echo '</div>';
?>