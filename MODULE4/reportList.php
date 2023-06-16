<!DOCTYPE html>
<html>
<head>

  <style>
    table {
      border-collapse: collapse;
      width: 100%;
    }

    th, td {
      padding: 8px;
      text-align: left;
      border-bottom: 1px solid #ddd;
    }

    tr:hover {
      background-color: #f5f5f5;
    }

    .update-btn, .delete-btn {
      padding: 4px 8px;
      border: none;
      cursor: pointer;
      font-size: 14px;
    }

    .update-btn {
      background-color: #4CAF50;
      color: white;
    }

    .delete-btn {
      background-color: #f44336;
      color: white;
    }
  </style>
</head>
<body>
    
  <img src="img.png" style="height:200px" width="1520px">
  <table>
    <thead>
        
  <title>Report List</title>
      <tr>
        <th>Name of Reporter</th>
        <th>Date and Time</th>
        <th>Report Type</th>
        <th>Report Details</th>
        <th>Status</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>John Doe</td>
        <td>2023-06-07 10:00</td>
        <td>Incident</td>
        <td>Something happened...</td>
        <td>Investigation</td>
        <td>
          <button class="update-btn">Update</button>
          <button class="delete-btn">Delete</button>
        </td>
      </tr>
      <!-- Add more rows for other reports -->
    </tbody>
  </table>

  <script>
    // JavaScript code for handling update and delete actions
    const updateButtons = document.querySelectorAll('.update-btn');
    const deleteButtons = document.querySelectorAll('.delete-btn');

    function handleUpdate() {
      // Get the report data and perform the update action
      const row = this.closest('tr');
      const reporter = row.cells[0].innerText;
      const dateTime = row.cells[1].innerText;
      const reportType = row.cells[2].innerText;
      const reportDetails = row.cells[3].innerText;
      const status = row.cells[4].innerText;

      // Perform the update action with the report data
      // ...

      // Example: Show an alert message
      alert(`Update report:\nReporter: ${reporter}\nDate and Time: ${dateTime}\nReport Type: ${reportType}\nReport Details: ${reportDetails}\nStatus: ${status}`);
    }

    function handleDelete() {
      // Get the report data and perform the delete action
      const row = this.closest('tr');
      const reporter = row.cells[0].innerText;
      const dateTime = row.cells[1].innerText;

      // Perform the delete action with the report data
      // ...

      // Example: Show an alert message
      alert(`Delete report:\nReporter: ${reporter}\nDate and Time: ${dateTime}`);
    }

    // Add event listeners to update and delete buttons
    updateButtons.forEach(btn => btn.addEventListener('click', handleUpdate));
    deleteButtons.forEach(btn => btn.addEventListener('click', handleDelete));
  </script>
</body>
</html>
