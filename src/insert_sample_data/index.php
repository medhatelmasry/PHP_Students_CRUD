<?php include("../inc_header.php"); ?>

<h1>Create Sample Data</h1>
<p>Click on the below button to Insert sample Students data.</p>
<?php
if (isset($_POST['Submit'])) {
    include("../inc_db_params.php");
    mysqli_select_db($conn, $db_name);

$row = 1;
if (($handle = fopen("../seed-data.csv", "r")) !== FALSE) {
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

        $SQLstring = "INSERT INTO Students (StudentId, FirstName, LastName, School) 
        VALUES 
        ('$id', '$firstName', '$lastName', '$school')
        ";
        $QueryResult = mysqli_query($conn, $SQLstring);
        echo $SQLstring;
        $rowcount=mysqli_affected_rows($conn);
        printf("<p>%d records were inserted.</p>\n", $rowcount);

    }
}
}
?>
<form action="/insert_sample_data/index.php" method="POST">
<p><input type="Submit" name="Submit" value="Insert data" class="btn btn-small btn-success"/></p>
</form>
<a href="/" class="btn btn-small btn-primary">&lt;&lt; BACK</a>

<?php include("../inc_footer.php"); ?>


