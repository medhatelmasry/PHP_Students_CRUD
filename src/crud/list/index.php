<?php include("../../inc_header.php"); ?>

<h1>List of Students</h1>

<p>
<a href="../../crud/create/create.php" class="btn btn-small btn-success">Create New</a>
</p>

<?php
include("../../inc_db_params.php");
mysqli_select_db($conn, $db_name);

if ($conn !== FALSE) {
    $SQLstring = "select * from Students";
    if ($QueryResult = @mysqli_query($conn, $SQLstring)) {
        echo "<table width='100%' class='table table-striped'>\n";
        echo "<tr><th>Student ID</th>".
             "<th>First Name</th>".
             "<th>Last Name</th>".
             "<th>School</th>".
             "<th>CRUD</th></tr>\n";
        while ($Row = mysqli_fetch_array($QueryResult, MYSQLI_NUM)) {
             echo "<tr><td>{$Row[0]}</td>";
             echo "<td>{$Row[1]}</td>";
             echo "<td>{$Row[2]}</td>";
             echo "<td>{$Row[3]}</td>";
             echo "<td>";
             echo "<a class='btn btn-small btn-primary' href='../../crud/display/display.php?id={$Row[0]}'>disp</a>";
             echo "&nbsp;";
             echo "<a class='btn btn-small btn-danger' href='../../crud/delete/delete.php?id={$Row[0]}'>del</a>";
             echo "&nbsp;";
             echo "<a class='btn btn-small btn-warning' href='../../crud/update/update.php?id={$Row[0]}'>upd</a>";
             echo "</td></tr>\n";
        };
        echo "</table>\n";

        echo "<p>Your query returned the above "
             . mysqli_num_rows($QueryResult)
             . " rows and ". mysqli_num_fields($QueryResult)
             . " columns.</p>";

        mysqli_free_result($QueryResult);
   }

   mysqli_close($conn);
}

?>
<a href="/" class="btn btn-small btn-primary">&lt;&lt; BACK</a>

<?php include("../../inc_footer.php"); ?>