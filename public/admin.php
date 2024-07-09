<?php
include '../config.php';

$tsql = "{CALL GetAllPatients}";
$stmt = sqlsrv_query($conn, $tsql);
if ($stmt === false) {
    die(print_r(sqlsrv_errors(), true));
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin View</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
            cursor: pointer;
        }
        th:hover {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h2>Admin View</h2>
        <table id="adminTable" class="table">
            <thead>
                <tr>
                    <th data-column="DateOfSubmission">Date of Submission</th>
                    <th data-column="FirstName">First Name</th>
                    <th data-column="Surname">Surname</th>
                    <th data-column="Age">Age</th>
                    <th data-column="DateOfBirth">DOB</th>
                    <th data-column="TotalScore">Total Score</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)): ?>
                    <tr>
                        <td><?php echo $row['DateOfSubmission']->format('Y-m-d H:i:s'); ?></td>
                        <td><?php echo $row['FirstName']; ?></td>
                        <td><?php echo $row['Surname']; ?></td>
                        <td><?php echo $row['Age']; ?></td>
                        <td><?php echo $row['DateOfBirth']->format('Y-m-d'); ?></td>
                        <td><?php echo $row['TotalScore']; ?></td>
                        <td>
                            <a href="edit-form.php?id=<?php echo $row['PainInventoryID']; ?>" class="btn btn-warning btn-sm">Edit</a>
                            <a href="delete.php?id=<?php echo $row['PainInventoryID']; ?>" class="btn btn-danger btn-sm">Delete</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>

    <script>
        // JavaScript for client-side sorting based on Total Score
        document.addEventListener('DOMContentLoaded', function() {
            const headers = document.querySelectorAll('#adminTable th[data-column]');
            
            headers.forEach(header => {
                header.addEventListener('click', () => {
                    const column = header.dataset.column;
                    let order = header.dataset.order = -(header.dataset.order || -1);
                    
                    const rows = Array.from(header.closest('table').querySelectorAll('tbody tr'));
                    
                    rows.sort((a, b) => {
                        const cellA = getDataValue(a, column);
                        const cellB = getDataValue(b, column);
                        
                        // Custom sorting logic based on column type
                        if (column === 'DateOfSubmission' || column === 'DateOfBirth') {
                            return order * (new Date(cellA) - new Date(cellB));
                        } else if (column === 'FirstName' || column === 'Surname') {
                            return order * cellA.localeCompare(cellB);
                        } else if (column === 'TotalScore') {
                            return order * (parseInt(cellA) - parseInt(cellB));
                        } else {
                            return 0; // No sorting by default
                        }
                    });
                    
                    // Toggle order for next click
                    order *= -1;
                    
                    // Update order indicator in headers
                    headers.forEach(h => {
                        if (h !== header) {
                            h.dataset.order = '';
                        }
                    });
                    header.dataset.order = order;
                    
                    // Append sorted rows back to tbody
                    const tbody = header.closest('table').querySelector('tbody');
                    rows.forEach(row => tbody.appendChild(row));
                });
            });

            function getDataValue(row, column) {
                const index = Array.from(row.parentNode.children).indexOf(row) + 1;
                return row.querySelector(`td:nth-child(${index})`).textContent.trim();
            }
        });
    </script>

</body>
</html>
