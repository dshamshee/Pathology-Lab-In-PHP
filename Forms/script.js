document.addEventListener('DOMContentLoaded', () => {
    const testSelect = document.getElementById('testSelect');
    const costInput = document.getElementById('cost');
    const addTestBtn = document.getElementById('addTestBtn');
    const testTable = document.getElementById('testTable');
    const totalAmountInput = document.getElementById('totalAmount');
    let totalAmount = 0;

    // Fetch test data from the server
    fetch('fetch_tests.php')
        .then(response => response.json())
        .then(data => {
            data.forEach(test => {
                const option = document.createElement('option');
                option.value = test.test_id;
                option.textContent = `${test.test_name} - ${test.cost}`;
                option.dataset.cost = test.cost;
                testSelect.appendChild(option);
            });
        });

    testSelect.addEventListener('change', () => {
        const selectedOption = testSelect.options[testSelect.selectedIndex];
        costInput.value = selectedOption.dataset.cost || 0;
    });

    addTestBtn.addEventListener('click', () => {
        const selectedOption = testSelect.options[testSelect.selectedIndex];
        if (selectedOption.value) {
            const row = document.createElement('tr');
            row.innerHTML = `
                <td>${selectedOption.value}</td>
                <td>${selectedOption.textContent.split(' - ')[0]}</td>
                <td>${selectedOption.dataset.cost}</td>
            `;
            testTable.appendChild(row);
            totalAmount += parseFloat(selectedOption.dataset.cost);
        }
    });

    document.getElementById('calculateBtn').addEventListener('click', () => {
        totalAmountInput.value = totalAmount;
    });
});
