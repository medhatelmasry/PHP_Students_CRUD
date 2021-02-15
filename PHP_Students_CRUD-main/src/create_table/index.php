<?php include("../inc_header.php"); ?>

<h1>Create Student Table</h1>
<p>Click on the below button to create a table named Students.</p>
<?php
if (isset($_POST['Submit'])) {
    include("../inc_db_params.php");
    // school db connection

    /* change db to world db */
    mysqli_select_db($conn, $db_name);

    if ($conn !== FALSE) {
        $SQLstring = "CREATE TABLE Students (
            StudentId VARCHAR(10) NOT NULL,
            FirstName VARCHAR(80),
            LastName VARCHAR(80),
            School VARCHAR(50),
            PRIMARY KEY (StudentId)
        );";
        $QueryResult = @mysqli_query($conn, $SQLstring);
        echo "\nsuccessfully created";
    }

    $conn->close();
}
?>
<form action="/create_table/index.php" method="POST">
<p><input type="Submit" name="Submit" value="Create Table" class="btn btn-small btn-success"/></p>
</form>
<a href="/" class="btn btn-small btn-primary">&lt;&lt; BACK</a>

<?php include("../inc_footer.php"); ?>