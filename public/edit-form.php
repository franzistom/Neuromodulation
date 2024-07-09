<?php
include '../config.php';

$painInventoryID = $_GET['id'];

$tsql = "{CALL GetPainInventoryByID(?)}";
$params = [$painInventoryID];
$stmt = sqlsrv_query($conn, $tsql, $params);
if ($stmt === false) {
    die(print_r(sqlsrv_errors(), true));
}

$row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
if ($row === false) {
    die("No records found for ID $painInventoryID");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Pain Inventory</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Edit Pain Inventory</h2>
        <form method="post" action="update.php">
            <input type="hidden" name="painInventoryID" value="<?php echo $painInventoryID; ?>">
            <div class="card">
                <div class="card-header">Patient Details</div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="firstName">First Name</label>
                        <input type="text" class="form-control" id="firstName" name="firstName" value="<?php echo $row['FirstName']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="surname">Surname</label>
                        <input type="text" class="form-control" id="surname" name="surname" value="<?php echo $row['Surname']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="dob">Date of Birth</label>
                        <input type="date" class="form-control" id="dob" name="dob" value="<?php echo $row['DateOfBirth']->format('Y-m-d'); ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="age">Age</label>
                        <input type="number" class="form-control" id="age" name="age" value="<?php echo $row['Age']; ?>" readonly>
                    </div>
                </div>
            </div>
            <div class="card mt-3">
                <div class="card-header">Brief Pain Inventory (BPI)</div>
                <?php   $questions = array(
                            "How much relief have pain treatments or medicaTons FROM THIS CLINIC provided?",
                            "Please rate your pain based on the number that best describes your pain at it’s WORST in the past week.",
                            "Please rate your pain based on the number that best describes your pain at it’s LEAST in the past week.",
                            "Please rate your pain based on the number that best describes your pain on the Average.",
                            "Please rate your pain based on the number that best describes your pain that tells how much pain you have RIGHT NOW.",
                            "Based on the number that best describes how during the past week pain has INTERFERED with your: General AcTvity.",
                            "Based on the number that best describes how during the past week pain has INTERFERED with your: Mood.",
                            "Based on the number that best describes how during the past week pain has INTERFERED with your: Walking ability.",
                            "Based on the number that best describes how during the past week pain has INTERFERED with your: Normal work (includes work both outside the home and housework).",
                            "Based on the number that best describes how during the past week pain has INTERFERED with your: RelaTonships with other people.",
                            "Based on the number that best describes how during the past week pain has INTERFERED with your: Sleep.",
                            "Based on the number that best describes how during the past week pain has INTERFERED with your: Enjoyment of life.",
                            
                        ); ?>
                <div class="card-body">
                    <?php for ($i = 1; $i <= 12; $i++): ?>
                        <div class="form-group">
                            <label for="question<?php echo $i-1; ?>">Question <?php echo $i-1; ?> :<?php echo $questions[$i-1]; ?></label>
                            <input type="number" class="form-control" id="question<?php echo $i-11; ?>" name="question<?php echo $i-1; ?>" value="<?php echo $row["Question$i"]; ?>" min="0" max="<?php echo $i == 1 ? 100 : 10; ?>" required>
                        </div>
                    <?php endfor; ?>
                </div>
            </div>
            <div class="card mt-3">
                <div class="card-header">Total Score</div>
                <div class="card-body">
                    <input type="text" class="form-control" id="totalScore" name="totalScore" value="<?php echo $row['TotalScore']; ?>" readonly>
                </div>
            </div>
            <button type="submit" class="btn btn-primary mt-3">Update</button>
        </form>
    </div>

    <script>
        $(document).ready(function() {
            $('input[id^="question"]').on('input', function() {
                let total = 0;
                for (let i = 2; i <= 12; i++) {
                    total += parseInt($(`#question${i}`).val()) || 0;
                }
                $('#totalScore').val(total);
            });
        });
    </script>
</body>
</html>
