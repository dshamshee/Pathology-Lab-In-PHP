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

// Fetch the last bill number from the bill table
$billQuery = "SELECT b_no FROM bill ORDER BY b_no DESC LIMIT 1";
$billResult = mysqli_query($conn, $billQuery);
$lastBillNo = mysqli_fetch_assoc($billResult)['b_no'] ?? 'B00';
$billNumber = 'B' . str_pad((substr($lastBillNo, 1) + 1), 2, '0', STR_PAD_LEFT);

// Assuming patient data is passed via GET/POST when redirected from the patient form
$patientId = $_GET['patient_id'] ?? '';
$patientName = $_GET['patient_name'] ?? '';
$patientGender = $_GET['gender'] ?? '';
$patientAge = $_GET['age'] ?? '';
$date = date('d-m-y'); // Fetch current date

// Insert bill data
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $totalAmount = $_POST['totalAmount'] ?? 0;
    $advanceAmount = $_POST['advanceAmount'] ?? 0;
    $duesAmount = $totalAmount - $advanceAmount;

    // Insert into the bill table
    $insertBillQuery = "INSERT INTO bill (b_no, b_date, total_amt, Advance_Payment, dues, pid) 
                        VALUES ('$billNumber', NOW(), '$totalAmount', '$advanceAmount', '$duesAmount', '$patientId')";
    if (mysqli_query($conn, $insertBillQuery)) {
        // Get the selected test IDs from the POST request
        $selectedTestIds = $_POST['tests'] ?? [];

        // Check if all selected test IDs exist in the `test` table
        $testExistsQuery = "SELECT COUNT(*) FROM test WHERE Tid IN (" . implode(',', array_map('intval', $selectedTestIds)) . ")";
        $testExistsResult = mysqli_query($conn, $testExistsQuery);
        $testExistsCount = mysqli_fetch_row($testExistsResult)[0];

        if ($testExistsCount < count($selectedTestIds)) {
            echo "Some test IDs do not exist in the test table.";
            exit; // Stop execution if any test ID is invalid
        }

        // Insert each selected test with the bill number one by one into the bill_test table
        foreach ($selectedTestIds as $testId) {
            $insertTestQuery = "INSERT INTO bill_test (b_no, tid) VALUES ('$billNumber', '$testId')";
            if (!mysqli_query($conn, $insertTestQuery)) {
                echo "Error inserting test: " . mysqli_error($conn);
            }
        }

        // Redirect or show success message
        echo "Bill saved successfully!";
    } else {
        echo "Error saving bill: " . mysqli_error($conn);
    }
    exit; // Prevent further page processing after saving
}
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

        function saveReceipt() {
            const form = document.getElementById('receiptForm');
            const selectedTestIds = selectedTests.map(test => test.Tid);
            const totalAmount = document.getElementById('totalAmount').value;
            const advanceAmount = document.getElementById('advanceAmount').value;

            // Add selected tests and other data to the form
            const testsInput = document.createElement('input');
            testsInput.type = 'hidden';
            testsInput.name = 'tests[]';
            testsInput.value = selectedTestIds.join(',');
            form.appendChild(testsInput);

            const totalInput = document.createElement('input');
            totalInput.type = 'hidden';
            totalInput.name = 'totalAmount';
            totalInput.value = totalAmount;
            form.appendChild(totalInput);

            const advanceInput = document.createElement('input');
            advanceInput.type = 'hidden';
            advanceInput.name = 'advanceAmount';
            advanceInput.value = advanceAmount;
            form.appendChild(advanceInput);

            form.submit(); // Submit form to save data
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
        <label>Bill No: <input type="text" value="<?php echo $billNumber; ?>" readonly></label>
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

    <form id="receiptForm" method="POST" style="display: none;">
        <input type="hidden" name="patientId" value="<?php echo $patientId; ?>">
    </form>

    <button type="button" onclick="saveReceipt()">Save</button>
</div>
</body>
</html>
