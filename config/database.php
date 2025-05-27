<?php

$serverName = "HP\\SQLEXPRESS"; // Note: double backslash in string
$connectionOptions = [
    "Database" => "portfolio",
    "Uid" => "", // Replace with actual SQL username
    "PWD" => ""  // Replace with actual SQL password
];

// Connect using SQLSRV
$conn = sqlsrv_connect($serverName, $connectionOptions);

if ($conn === false) {
    die(print_r(sqlsrv_errors(), true));
}
// Your database connection is now established.
$sql = "SELECT * FROM subjects";    
$stmt = sqlsrv_query($conn, $sql);

if ($stmt === false){
    die(print_r(sqlsrv_errors(), true));
}// Example query

$subjects = [];

//fetching data into an array
while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
    $subjects[] = $row;
    //print_r($row); die;
}

sqlsrv_close($conn);

?>
