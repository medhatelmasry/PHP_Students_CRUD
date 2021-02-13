<?php
if (isset($_POST['StudentId'])) {
    include("../../inc_db_params.php");

    /* change db to world db */
    mysqli_select_db($conn, $db_name);

    if ($conn !== FALSE) {
        $id = $_POST['StudentId'];

        /* create a prepared statement */
        if ($stmt = mysqli_prepare($conn, "DELETE FROM Students WHERE StudentId=?")) {

            /* bind parameters for markers */
            mysqli_stmt_bind_param($stmt, "s", $id);

            /* execute query */
            $exec = mysqli_stmt_execute($stmt);

            // Check if execute() failed. 
            // execute() can fail for various reasons. 
            // And may it be as stupid as someone tripping over the network cable

            if ($exec === false) {
                error_log('mysqli execute() failed: ');
                error_log(print_r(htmlspecialchars($stmt->error), true));
            }
        }
    };

    mysqli_stmt_close($stmt);
    mysqli_close($conn);

    if ($exec === true) {
        header('Location: ../list');
        exit;
    }
} else {
    # TODO without StudentId value causes errors
}
?>