<?php

include_once 'db_conn.php';

$query = $conn->query("SELECT * FROM employees ORDER BY id ASC");

if ($query->num_rows > 0) {
    $delimiter = ",";
    $filename = "employees_info" . date('d-m-y_h-m-s') . ".csv";

    // Create a file pointer 
    $f = fopen('php://memory', 'w');

    // Set column headers 
    $fields = array('id', 'name', 'user_id', 'date', 'time');
    fputcsv($f, $fields, $delimiter);

    // Output each row of the data, format line as csv and write to file pointer 
    while ($row = $query->fetch_assoc()) {
        $lineData = array($row['id'], $row['name'], $row['user_id'], $row['date'], $row['time']);
        fputcsv($f, $lineData, $delimiter);
    }

    // Move back to beginning of file 
    fseek($f, 0);

    // Set headers to download file rather than displayed 
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="' . $filename . '";');

    //output all remaining data on a file pointer 
    fpassthru($f);
}
//header("Location: ../display.php");
exit;
