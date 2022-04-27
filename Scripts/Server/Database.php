<?php
// Create a function that can be used to connect to the database.
function database_connect()
{
    // Create variables for database credentials
    $serverName = "localhost";
    $username = "root";
    $password = "";
    $databaseName = "web_technologies_ass2";
    // Initiate the connection between the database and the script
    $connection = mysqli_connect($serverName, $username, $password, $databaseName);
    // Create a fail-safe for if the database connection was unsuccessful
    if (!$connection)
    {
        die("Database connection failed: " . mysqli_connect_error());
    }
    else
    {
        return $connection; // Return the connection, if successful
    }
}
// Create a function which can execute prepared statements
function prepare_statement($statement, $parameters)
{
    // The syntax for prepared statements was learned from w3schools (n.d c)
    // Open the database connection
    $database_connection = database_connect();
    // Create the statement
    $prepared_statement = $database_connection->prepare($statement);
    // Add the parameters to the statement
    $prepared_statement->bind_param(...$parameters);
    // Execute the statement
    if ($prepared_statement->execute())
    {
        return $prepared_statement->get_result();
    }
    else
    {
        return "failed";
        die("Prepared statement failed");
    }
    // Close the database connection
    $database_connection->close();
}
// Create a function to obtain the next primary key, if integer
function get_next_primary_key($table_name)
{
    // Open the database connection
    $database_connection = database_connect();
    // Write the statement
    $sql_next_primary_key = "SELECT auto_increment FROM INFORMATION_SCHEMA.TABLES WHERE table_name = '" . $table_name . "';";
    $query_next_primary_key = $database_connection->query($sql_next_primary_key);
    // Get the data
    $next_primary_key = $query_next_primary_key->fetch_row();
    return $next_primary_key[0];
    // Close database connection
    $database_connection->close();
}
?>