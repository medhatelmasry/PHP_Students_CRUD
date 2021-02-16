<?php include("../../inc_header.php"); ?>

<h1>Confirm Delete Student</h1>

<?php
if (isset($_GET['id'])) {
    include("../inc_db_params_crud.php");
    $ShowTable = TRUE;

    if ($using_mysql) {
        /* change db to world db */
        mysqli_select_db($conn, $db_name);

        if ($conn !== FALSE) {
            $id = $_GET['id'];

            /* create a prepared statement */
            if ($stmt = mysqli_prepare($conn, "SELECT * FROM Students WHERE StudentId=?")) {

                /* bind parameters for markers */
                mysqli_stmt_bind_param($stmt, "s", $id);

                /* execute query */
                mysqli_stmt_execute($stmt);

                /* bind variables to prepared statement */
                mysqli_stmt_bind_result($stmt, $StudentId, $FirstName, $LastName, $School);

                /* fetch value */
                mysqli_stmt_fetch($stmt);
            }
        };

        mysqli_stmt_close($stmt);
        mysqli_close($conn);
    } else {
        $id = $_GET['id'];
        
        $prepared_stmt = $db->prepare("SELECT * FROM Students WHERE StudentId=?");
        $prepared_stmt->bindParam(1, $id);
        $res = $prepared_stmt->execute();
        $row = $res->fetchArray(SQLITE3_NUM);

        $StudentId = $row[0];
        $FirstName = $row[1];
        $LastName = $row[2];
        $School = $row[3];
    }
} else {
    $ShowTable = FALSE;
    $StudentId = "";
    $FirstName = "";
    $LastName = "";
    $School = "";
    echo "<h4><br>The URL is invalid. An id parameter must be given.<h4>\n";
}
if ($ShowTable) {
?>

<table>
    <tr>
        <td>Student ID:</td>
        <td><?php echo $StudentId ?></td>
    </tr>
    <tr>
        <td>First name: </td>
        <td><?php echo $FirstName ?></td>
    </tr>
    <tr>
        <td>Last name: </td>
        <td><?php echo $LastName ?></td>
    </tr>
    <tr>
        <td>School: </td>
        <td><?php echo $School ?></td>
    </tr>
</table>
<?php
}
?>
<br />
<form action="process_delete.php" method="post">
    <input type="hidden" value="<?php echo $StudentId ?>" name="StudentId" />
    <a href="../list" class="btn btn-small btn-primary">&lt;&lt; BACK</a>
    &nbsp;&nbsp;&nbsp;
    <input type="submit" value="Delete" class="btn btn-danger" />
</form>

<br />


<?php include("../../inc_footer.php"); ?>