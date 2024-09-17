<?php
require 'config/database.php';

$query = "SELECT * FROM portfolio_db.contacts";
$stmt = $pdo->prepare($query);
$stmt->execute();
$contacts = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Contact Submissions</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
    </style>
    <script>
        function deleteData(id) {
            if (confirm("Are you sure you want to delete this entry?")) {
                fetch('delete.php?id=' + id, {
                    method: 'GET'
                })
                .then(response => response.text())
                .then(data => {
                    if (data === 'success') {
                        document.getElementById('row-' + id).remove();
                    } else {
                        alert('Failed to delete the entry.');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                });
            }
        }
    </script>
</head>
<body>
    <h1>All Contact Submissions</h1>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Subject</th>
                <th>Message</th>
                <th>Submitted At</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($contacts as $contact): ?>
            <tr id="row-<?php echo htmlspecialchars($contact['id']); ?>">
                <td><?php echo htmlspecialchars($contact['id']); ?></td>
                <td><?php echo htmlspecialchars($contact['name']); ?></td>
                <td><?php echo htmlspecialchars($contact['email']); ?></td>
                <td><?php echo htmlspecialchars($contact['subject']); ?></td>
                <td><?php echo htmlspecialchars($contact['message']); ?></td>
                <td><?php echo htmlspecialchars($contact['created_at']); ?></td>
                <td><button onclick="deleteData(<?php echo $contact['id']; ?>)">Delete</button></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
