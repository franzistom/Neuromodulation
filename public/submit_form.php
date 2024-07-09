    <?php
    include '../config.php';

    $firstName = $_POST['firstName'];
    $surname = $_POST['surname'];
    $dob = $_POST['dob'];
    $age = $_POST['age'];
    $questions = [];
    for ($i = 0; $i <= 11; $i++) {
        $questions[$i+1] = $_POST["question$i"];
    }

    $tsql = "{CALL InsertPatient(?, ?, ?, ?)}";
    $params = [$firstName, $surname, $dob, $age];
    $stmt = sqlsrv_query($conn, $tsql, $params);
    if ($stmt === false) {
        die(print_r(sqlsrv_errors(), true));
    }

    sqlsrv_next_result($stmt);
    sqlsrv_fetch($stmt);
    $newPatientID = sqlsrv_get_field($stmt, 0);

    $tsql = "{CALL InsertPainInventory(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)}";
    $params = array_merge([$newPatientID], array_values($questions));
    $stmt = sqlsrv_query($conn, $tsql, $params);
    if ($stmt === false) {
        die(print_r(sqlsrv_errors(), true));
    }

    header("Location: admin.php");
    exit();
    ?>
