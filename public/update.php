<?php
include '../config.php';

$painInventoryID = $_POST['painInventoryID'];
$firstName = $_POST['firstName'];
$surname = $_POST['surname'];
$dob = $_POST['dob'];
$age = $_POST['age'];
$questions = [];
for ($i = 0; $i <= 11; $i++) {
    $questions[$i+1] = $_POST["question$i"];
}

$tsql = "{CALL UpdatePainInventory(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)}";
$params = array_merge([$painInventoryID], array_values($questions));
$stmt = sqlsrv_query($conn, $tsql, $params);
if ($stmt === false) {
    die(print_r(sqlsrv_errors(), true));
}

header("Location: admin.php");
exit();
?>
