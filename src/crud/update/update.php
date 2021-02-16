<?php include("../../inc_header.php"); ?>

<?php
if (isset($_GET['id'])) {
    include("../inc_db_params_crud.php");
    $ShowDiv = TRUE;

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
    $ShowDiv = FALSE;
    $StudentId = "";
    $FirstName = "";
    $LastName = "";
    $School = "";
    echo "<h4><br>The URL is invalid. An id parameter must be given.<h4>\n";
}
if ($ShowDiv) {
?>

<h1>Update</h1>

<div class="row">
    <div class="col-md-4">
        <form action="process_update.php" method="post">

            <div class="form-group">
                <input type="hidden" value="<?php echo $StudentId ?>" name="StudentId" />
                <label class="control-label">Student ID</label>
                <?php echo $StudentId ?>
            </div>

            <div class="form-group">
                <label for="FirstName" class="control-label">First Name</label>
                <input for="FirstName" class="form-control" name="FirstName" id="FirstName" 
                    value="<?php echo $FirstName; ?>" />
            </div>

            <div class="form-group">
                <label for="LastName" class="control-label">Last Name</label>
                <input for="LastName" class="form-control" name="LastName" id="LastName" 
                    value="<?php echo $LastName; ?>" />
            </div>

            <div class="form-group">
                <label for="School" class="control-label">School</label>
                <input for="School" class="form-control" name="School" id="School" 
                    value="<?php echo $School; ?>" />
            </div>

            <div class="form-group">
                <a href="../list" class="btn btn-small btn-primary">&lt;&lt; BACK</a>
                &nbsp;&nbsp;&nbsp;
                <input type="submit" value="Update" name="update" class="btn btn-warning" />
            </div>
        </form>
    </div>
</div>
<?php
}
?>
<?php
if ($ShowDiv == FALSE) {
?>
<br>
<a href="../list" class="btn btn-small btn-primary">&lt;&lt; BACK</a>
<?php
}
?>

<br />


<?php include("../../inc_footer.php"); ?>