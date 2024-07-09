<?php
include '../config.php';

$painInventoryID = $_GET['id'];

$tsql = "{CALL DeletePainInventory(?)}";
$params = [$painInventoryID];
$stmt = sqlsrv_query($conn, $tsql, $params);
if ($stmt === false) {
    die(print_r(sqlsrv_errors(), true));
}

header("Location: admin.php");
exit();
?>
