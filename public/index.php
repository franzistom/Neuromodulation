<?php include '../config.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Neuromodulation</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
</head>
<body>
    <div class="container mt-5">
        <h2>Neuromodulation</h2>
        <form id="painForm" method="post" action="submit_form.php">
            <div class="card">
                <div class="card-header">Patient Details</div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="firstName">First Name</label>
                        <input type="text" class="form-control" id="firstName" name="firstName" required>
                    </div>
                    <div class="form-group">
                        <label for="surname">Surname</label>
                        <input type="text" class="form-control" id="surname" name="surname" required>
                    </div>
                    <div class="form-group">
                        <label for="dob">Date of Birth</label>
                        <input type="date" class="form-control" id="dob" name="dob" required>
                    </div>
                    <div class="form-group">
                        <label for="age">Age</label>
                        <input type="number" class="form-control" id="age" name="age" readonly>
                    </div>
                </div>
            </div>
            <div class="card mt-3">
                <div class="card-header">Brief Pain Inventory (BPI)</div>

     
                <div class="card-body">

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
                    <?php for ($i = 0; $i <= 11; $i++): ?>
                        <div class="form-group">
                        <label for="question<?php echo $i + 1; ?>"># <?php echo $i + 1; ?>: <?php echo $questions[$i]; ?></label>
                            <input type="number" class="form-control" id="question<?php echo $i; ?>" name="question<?php echo $i; ?>" min="0" max="<?php echo $i == 0 ? 100 : 10; ?>" required>
                        </div>
                    <?php endfor; ?>
                </div>
            </div>
            <div class="card mt-3">
                <div class="card-header">Total Score</div>
                <div class="card-body">
                    <input type="text" class="form-control" id="totalScore" name="totalScore" readonly>
                </div>
            </div>
            <button type="submit" class="btn btn-primary mt-3">Submit</button>
        </form>
    </div>

    <script>
       
        $(document).ready(function() {
            $('#dob').on('change', function() {
                const dob = new Date($(this).val());
                const ageDifMs = Date.now() - dob.getTime();
                const ageDate = new Date(ageDifMs);
                $('#age').val(Math.abs(ageDate.getUTCFullYear() - 1970));
            });

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
