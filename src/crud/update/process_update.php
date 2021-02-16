<?php
if (isset($_POST['update'])) {

    include("../inc_db_params_crud.php");
    include("../../utils.php");

    $sql = "";
    $sql .= " UPDATE Students SET FirstName=?, LastName=?, School=?";
    $sql .= " WHERE StudentId=?";

    extract($_POST);

    $StudentId = sanitize_input($StudentId);
    $FirstName = sanitize_input($FirstName);
    $LastName = sanitize_input($LastName);
    $School = sanitize_input($School);

    if ($using_mysql) {
        /* change db to world db */
        mysqli_select_db($conn, $db_name);

        if ($conn !== FALSE) {
            /* stores the varchar length for each column in order */
            $max_chars_for_columns = array();

            /* gets the varchar length for each column */
            if ($result=mysqli_query($conn,'DESCRIBE Students')) {
                while ($row = mysqli_fetch_assoc($result)) {
                    preg_match('/(?<=\()\d+?(?=\))/', $row["Type"], $matches);
                    array_push($max_chars_for_columns, $matches[0]);
                }
                $result -> free_result();
            } else {
                printf("Error: %s\n", mysqli_error($conn));
            }

            /* dies if input length exceeds column's allowed length */
            if (strlen($StudentId) > $max_chars_for_columns[0]) {
                die("StudentId can only have {$max_chars_for_columns[0]} characters");
            }
            if (strlen($FirstName) > $max_chars_for_columns[1]) {
                die("FirstName can only have {$max_chars_for_columns[1]} characters");
            }
            if (strlen($LastName) > $max_chars_for_columns[2]) {
                die("LastName can only have {$max_chars_for_columns[2]} characters");
            }
            if (strlen($School) > $max_chars_for_columns[3]) {
                die("School can only have {$max_chars_for_columns[3]} characters");
            }

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
    } else {
        $prepared_stmt = $db->prepare($sql);
    
        $prepared_stmt->bindParam(1, $FirstName);
        $prepared_stmt->bindParam(2, $LastName);
        $prepared_stmt->bindParam(3, $School);
        $prepared_stmt->bindParam(4, $StudentId);

        $exec = $prepared_stmt->execute();

        if ($exec === false) {
            error_log("SQLite3 execute() failed: ");
            error_log(print_r(htmlspecialchars($prepared_stmt->lastErrorMsg())));
        }
    }

    if ($exec == true) {
        header('Location: ../list');
        exit;
    }
}
