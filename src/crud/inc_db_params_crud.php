<?php

$using_mysql = false;

// I realize that this isn't a good way to implement this function, and I will
// continue looking for a better alternative.
try {
    // If MySQL is used
    getenv('MYSQL_DBHOST') ? $db_host=getenv('MYSQL_DBHOST') : $db_host="localhost";
    getenv('MYSQL_DBPORT') ? $db_port=getenv('MYSQL_DBPORT') : $db_port="3333";
    getenv('MYSQL_DBUSER') ? $db_user=getenv('MYSQL_DBUSER') : $db_user="root";
    getenv('MYSQL_DBPASS') ? $db_pass=getenv('MYSQL_DBPASS') : $db_pass="secret";
    getenv('MYSQL_DBNAME') ? $db_name=getenv('MYSQL_DBNAME') : $db_name="";

    if (strlen( $db_name ) === 0) {
        $conn = new mysqli("$db_host:$db_port", $db_user, $db_pass);
        $db_name = "school";
    } else {
        $conn = new mysqli("$db_host:$db_port", $db_user, $db_pass, $db_name);
    }

    // list of db params to different tables
    $conn = mysqli_connect("$db_host:$db_port", $db_user, $db_pass);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } else {
        $using_mysql = true;
        echo "\nMySQL Connected successfully";
    }
} catch (Error $e) {
	$db = new SQLite3('../../school.db');

    echo "\nSQLite3 Connected successfully";
}

?>