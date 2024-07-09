
<?php
$serverName = "localhost\\SQLEXPRESS"; // edit if different
$connectionOptions = array(
    "Database" => "Neuromodulation",
    "Uid" => "tom",       // edit if different
    "PWD" => "asdfgh"    // edit if different
);

// $connectionOptions = array(
//     "Database" => "Neuromodulation",
//     "UID" => "",
//     "PWD" => "",
//     "TrustServerCertificate" => true,
//     "CharacterSet" => "UTF-8",
//     "Authentication" => SQLSRV_AUTHENTICATION_INTEGRATED
// );


try {
    $conn = sqlsrv_connect($serverName, $connectionOptions);
    if ($conn) {
        echo "Connection established.<br />";
    } else {
        print_r(sqlsrv_errors());
    }
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "<br />";
}
?>