<?php
if (isset($_POST['StudentId'])) {
    include("../inc_db_params_crud.php");

    

    if ($using_mysql) {
        $stmt = mysqli_prepare($conn, "DELETE FROM Students WHERE StudentId=?");

        /* change db to world db */
        mysqli_select_db($conn, $db_name);

        if ($conn !== FALSE) {
            $id = $_POST['StudentId'];

            /* create a prepared statement */
            if ($stmt) {
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
    } else {
        $prepared_stmt = $db->prepare("DELETE FROM Students WHERE StudentId=?");
        $id = $_Post['StudentId'];
        $prepared_stmt->bindParam(1, $id);

        $exec = $prepared_stmt->execute();

        if ($exec === false) {
            error_log("SQLite3 execute() failed: ");
            error_log(print_r(htmlspecialchars($prepared_stmt->lastErrorMsg())));
        }
    }

    if ($exec === true) {
        header('Location: ../list');
        exit;
    }
}
?>