<?php
if (isset($_POST['update'])) {

    include("../../inc_db_params.php");
    include("../../utils.php");

    /* change db to world db */
    mysqli_select_db($conn, $db_name);

    if ($conn !== FALSE) {
        extract($_POST);

        $StudentId = sanitize_input($StudentId);
        $FirstName = sanitize_input($FirstName);
        $LastName = sanitize_input($LastName);
        $School = sanitize_input($School);

        # TODO handle buffer overflow. 
        # Make sure that length of string does not exceed schema for column 

        $sql = "";
        $sql .= " UPDATE Students SET FirstName=?, LastName=?, School=?";
        $sql .= " WHERE StudentId=?";

        /* create a prepared statement */
        if ($stmt = mysqli_prepare($conn, $sql)) {

            /* bind parameters for markers */
            mysqli_stmt_bind_param($stmt, "ssss", $FirstName, $LastName, $School, $StudentId);

            /* execute query */
            $exec = mysqli_stmt_execute($stmt);

            if ($exec === false) {
                error_log('mysqli execute() failed: ');
                error_log(print_r(htmlspecialchars($stmt->error), true));
            }
        }
    };

    mysqli_stmt_close($stmt);
    mysqli_close($conn);

?>
    <?php include("../../inc_to_list.php"); ?>
<?php
}
?>