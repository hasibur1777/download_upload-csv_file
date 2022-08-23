<?php
// include mysql database configuration file
include_once 'db_conn.php';

if (isset($_POST['submit'])) {

    // Allowed mime types
    $fileMimes = array(
        'text/x-comma-separated-values',
        'text/comma-separated-values',
        'application/octet-stream',
        'application/vnd.ms-excel',
        'application/x-csv',
        'text/x-csv',
        'text/csv',
        'application/csv',
        'application/excel',
        'application/vnd.msexcel',
        'text/plain'
    );

    // Validate whether selected file is a CSV file
    if (!empty($_FILES['file']['name']) && in_array($_FILES['file']['type'], $fileMimes)) {

        // Open uploaded CSV file with read-only mode
        $csvFile = fopen($_FILES['file']['tmp_name'], 'r');

        // Skip the first line
        fgetcsv($csvFile);

        // Parse data from CSV file line by line
        // Parse data from CSV file line by line
        while (($getData = fgetcsv($csvFile, 10000, ",")) !== FALSE) {
            // Get row data
            $id = $getData[0];
            $name = $getData[1];
            $user_id = $getData[2];
            $date = $getData[3];
            $time = $getData[4];

            if ($id != "" and $user_id != "") {
                $query = "SELECT id FROM employees WHERE user_id = '" . $getData[2] . "'";

                $check = mysqli_query($conn, $query);

                if ($check->num_rows > 0) {
                    mysqli_query($conn, "UPDATE employees SET name = '" . $name . "', user_id = '" . $user_id . "', date = '" . $date . "', time = '" . $time . "' WHERE user_id = '" . $user_id . "'");
                } else {
                    mysqli_query($conn, "INSERT INTO employees (name, user_id, date, time) VALUES ('" . $name . "', '" . $user_id . "', '" . $date . "', '" . $time . "')");
                }
            }
        }

        // Close opened CSV file
        fclose($csvFile);

        header("Location: ../catch_csv.php");
    } else {
        echo "Please select valid file";
    }
}
