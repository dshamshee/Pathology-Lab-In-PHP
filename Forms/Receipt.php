<?php
require_once '../config/db.php'; // Include database connection

// Fetch tests from the database
$query = "SELECT Tid, TName, Cost FROM test";
$result = mysqli_query($conn, $query);

$tests = [];
if ($result && mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $tests[] = $row;
    }
}

// Assuming patient data is passed via GET/POST when redirected from the patient form
$patientId = $_GET['patient_id'] ?? '';
$patientName = $_GET['patient_name'] ?? '';
$patientGender = $_GET['gender'] ?? '';
$patientAge = $_GET['age'] ?? '';
$patientBillNo = $_GET['bill_no'] ?? '';
$date = date('d-m-y'); // Fetch current date
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Receipt</title>
    <link rel="stylesheet" href="Receipt.css" class="src">
    <style>
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
    </style>
    <script>
        let tests = <?php echo json_encode($tests); ?>;
        let selectedTests = [];

        function addTest() {
            const selectElement = document.getElementById('testSelect');
            const selectedValue = selectElement.value;
            const selectedTest = tests.find(test => test.TName === selectedValue);

            if (selectedTest && !selectedTests.some(test => test.Tid === selectedTest.Tid)) {
                selectedTests.push(selectedTest);
                displayTests();
            }
        }

        function displayTests() {
            const tableBody = document.getElementById('testTableBody');
            tableBody.innerHTML = '';

            let totalCost = 0;

            selectedTests.forEach(test => {
                totalCost += parseFloat(test.Cost);
                const row = `
                    <tr>
                        <td>${test.Tid}</td>
                        <td>${test.TName}</td>
                        <td>${test.Cost}</td>
                    </tr>
                `;
                tableBody.innerHTML += row;
            });

            document.getElementById('totalAmount').value = totalCost;
        }

        function calculateDues() {
            const totalAmount = parseFloat(document.getElementById('totalAmount').value) || 0;
            const advanceAmount = parseFloat(document.getElementById('advanceAmount').value) || 0;
            document.getElementById('duesAmount').value = totalAmount - advanceAmount;
        }
    </script>
</head>
<body>
<div class="container">
    <h2>Receipt</h2>
    <div>
        <label>Patient Id: <input type="text" value="<?php echo htmlspecialchars($patientId); ?>" readonly></label>
        <label>Name: <input type="text" value="<?php echo htmlspecialchars($patientName); ?>" readonly></label>
        <label>Gender: <input type="text" value="<?php echo htmlspecialchars($patientGender); ?>" readonly></label>
        <label>Age: <input type="text" value="<?php echo htmlspecialchars($patientAge); ?>" readonly></label>
        <label>Bill No: <input type="text" value="<?php echo htmlspecialchars($patientBillNo); ?>" readonly></label>
        <label>Date: <input type="text" value="<?php echo htmlspecialchars($date); ?>" readonly></label>
    </div>

    <h3>Select Test</h3>
    <div>
        <label>Test Names: 
            <select id="testSelect">
                <?php foreach ($tests as $test): ?>
                    <option value="<?php echo htmlspecialchars($test['TName']); ?>">
                        <?php echo htmlspecialchars($test['TName']); ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </label>
        <button type="button" onclick="addTest()">Add Test</button>
    </div>

    <h3>Selected Tests</h3>
    <table>
        <thead>
            <tr>
                <th>Test ID</th>
                <th>Test Name</th>
                <th>Cost</th>
            </tr>
        </thead>
        <tbody id="testTableBody">
            <!-- Test rows will be added here -->
        </tbody>
    </table>

    <div>
        <label>Total Amount: <input type="text" id="totalAmount" readonly></label>
        <label>Advance: <input type="text" id="advanceAmount" oninput="calculateDues()"></label>
        <label>Dues: <input type="text" id="duesAmount" readonly></label>
    </div>

    <button type="button" onclick="alert('Data Saved!')">Save</button>
</div>
</body>
</html>
