<?php

require_once 'database.php';
$result = mysqli_query($con, 'SELECT * FROM Sales');
if (!$result) die('Couldn\'t fetch records');


//get fields and store into arrow
$num_fields = mysqli_num_fields($result);
$headers = array();
while ($fieldinfo = mysqli_fetch_field($result)) {
    $headers[] = $fieldinfo->name;
}

//create file and store value
$fp = fopen('php://output', 'w');
if ($fp && $result) {
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="export.csv"');
    header('Pragma: no-cache');
    header('Expires: 0');
    fputcsv($fp, $headers);
    while ($row = $result->fetch_array(MYSQLI_NUM)) {
        fputcsv($fp, array_values($row));
    }
    die;
}
?>

<!--
help from:
http://stackoverflow.com/questions/4249432/export-to-csv-via-php?rq=1
http://stackoverflow.com/questions/15699301/export-mysql-data-to-excel-in-php?rq=1
http://stackoverflow.com/questions/125113/php-code-to-convert-a-mysql-query-to-csv
-->