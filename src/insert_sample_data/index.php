<?php include("../inc_header.php"); ?>

<h1>Create Sample Data</h1>
<p>Click on the below button to Insert sample Students data.</p>
<?php
if (isset($_POST['Submit'])) {
    include("../inc_db_params.php");
    mysqli_select_db($conn, $db_name);

    if ($conn !== FALSE) {
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

        $conn->close();
    }
}
?>
<form action="/insert_sample_data/index.php" method="POST">
<p><input type="Submit" name="Submit" value="Insert data" class="btn btn-small btn-success"/></p>
</form>
<a href="/" class="btn btn-small btn-primary">&lt;&lt; BACK</a>

<?php include("../inc_footer.php"); ?>