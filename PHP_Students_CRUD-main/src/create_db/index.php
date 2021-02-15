<?php include("../inc_header.php"); ?>

<h1>Create School Database</h1>
<p>Click on the below button to create a database named School.</p>
<?php
if (isset($_POST['Submit'])) {
    include("../inc_db_params.php");
    if ($conn !== FALSE) {
        $SQLstring = "CREATE DATABASE $db_name;";
        $QueryResult = @mysqli_query($conn, $SQLstring);
        echo "\nsuccessfully added";
    };

    mysqli_close($conn);
}
?>
<form action="/create_db/index.php" method="POST">
<p><input type="Submit" name="Submit" value="Create Database" class="btn btn-small btn-success"/></p>
</form>
<a href="/" class="btn btn-small btn-primary">&lt;&lt; BACK</a>

<?php include("../inc_footer.php"); ?>
