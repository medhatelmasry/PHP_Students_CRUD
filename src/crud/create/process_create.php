<?php
if (isset($_POST['create'])) {

    include("../../inc_db_params.php");
    include("../../utils.php");

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

        extract($_POST);

        $StudentId = sanitize_input($StudentId);
        $FirstName = sanitize_input($FirstName);
        $LastName = sanitize_input($LastName);
        $School = sanitize_input($School);

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

        # TODO handle buffer overflow. 
        # Make sure that length of string does not exceed schema for column 

        $sql = "";
        $sql .= "INSERT INTO Students (StudentId, FirstName, LastName, School) VALUES ";
        $sql .= "(?, ?, ?, ?)";

        /* create a prepared statement */
        if ($stmt = mysqli_prepare($conn, $sql)) {

            /* bind parameters for markers */
            mysqli_stmt_bind_param($stmt, "ssss", $StudentId, $FirstName, $LastName, $School);

            /* execute query */
            $exec = mysqli_stmt_execute($stmt);

            if ($exec === false) {
                error_log('mysqli execute() failed: ');
                error_log(print_r(htmlspecialchars($stmt->error), true));
            }
        }
        mysqli_stmt_close($stmt);
    };

    mysqli_close($conn);

    if ($exec === true) {
        # redirect to the page that displays a list of students
        header('Location: ../list');
        exit;
    }
}
