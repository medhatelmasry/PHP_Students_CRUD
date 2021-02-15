<?php
// this is a combination of AUTO db, table creation and data insertion
include("./inc_db_params.php");
// checks connection
if ($conn !== FALSE) {
    //creates db only if it does not exists
    $SQLstring = "CREATE DATABASE IF NOT EXISTS $db_name;";
    $QueryResult = @mysqli_query($conn, $SQLstring);
}
// selects School db
mysqli_select_db($conn, $db_name);
// creates Student table
if ($conn !== FALSE) {
    $SQLstring = "CREATE TABLE IF NOT EXISTS Students (
        StudentId VARCHAR(10) NOT NULL,
        FirstName VARCHAR(80),
        LastName VARCHAR(80),
        School VARCHAR(50),
        PRIMARY KEY (StudentId)
    );";
    $QueryResult = @mysqli_query($conn, $SQLstring);
}
if ($conn !== FALSE) {
    $QueryResult = @mysqli_query($conn, $SQLstring);
    // checks if Student table is empty
    $SQLemptyTableCheck = "SELECT count(*) from Students";
    $result = mysqli_query($conn, $SQLemptyTableCheck);
    $count = mysqli_fetch_array($result)[0];
    // if empty, insert sample data
    if ($count == 0) {
        $SQLstring = "INSERT INTO Students (StudentId, FirstName, LastName, School) 
        VALUES 
        ('A00111111', 'Tom', 'Max', 'Science'),
        ('A00222222', 'Ann', 'Fay', 'Mining'),
        ('A00333333', 'Joe', 'Sun', 'Nursing'),
        ('A00444444', 'Sue', 'Fox', 'Computing'),
        ('A00555555', 'Ben', 'Ray', 'Mining')
        ";
        $QueryResult = mysqli_query($conn, $SQLstring);
        $rowcount=mysqli_affected_rows($conn);
        printf("<p>%d records were inserted.</p>\n", $rowcount);
    } 
}
print("Data are all set and ready to use");
// close connection to db
mysqli_close($conn);
?>