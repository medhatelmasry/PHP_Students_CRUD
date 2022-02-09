<?php
ini_set('display_errors', '1');
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
        $row = 1;
        if (($handle = fopen("seed-data.csv", "r")) !== FALSE) {
            $data = fgetcsv($handle, 1000, ",");
            while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                
                $num = count($data);
                echo "<p> $num fields in line $row: <br /></p>\n";
                $row++;
                // for ($c=0; $c < $num; $c++) {     
                //     echo $data[$c] . "<br />\n";     
                // }
        
                $id = mysqli_real_escape_string($conn, $data[0]);
                $firstName = mysqli_real_escape_string($conn, $data[1]);
                $lastName = mysqli_real_escape_string($conn, $data[2]);
                $school = mysqli_real_escape_string($conn, $data[3]);
        
                $SQLstring = "INSERT INTO Students (StudentId, FirstName, LastName, School)";
                $SQLstring .= " VALUES "; 
                $SQLstring .= " ('$id', '$firstName', '$lastName', '$school')";
                $QueryResult = mysqli_query($conn, $SQLstring);
                echo $SQLstring;
                $rowcount=mysqli_affected_rows($conn);
                printf("<p>%d records were inserted.</p>\n", $rowcount);
        
            }
        }
    } 
}
print("Data are all set and ready to use");
// close connection to db
mysqli_close($conn);
?>