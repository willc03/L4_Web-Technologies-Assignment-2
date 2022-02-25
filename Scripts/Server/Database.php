<?php
// Create a function that can be used to connect to the database.
function database_connect()
{
    // Create variables for database credentials
    $serverName = "localhost";
    $username = "root";
    $password = "password";
    $databaseName = "web_technologies_ass2";
    // Initiate the connection between the database and the script
    $connection = mysqli_connect($serverName, $username, $password, $databaseName);
    // Create a fail-safe for if the database connection was unsuccessful
    if (!$connection)
    {
        die("Database connection failed: " . mysql_connect_error());
    }
    else
    {
        return $connection; // Return the connection, if successful
    }
}
?>