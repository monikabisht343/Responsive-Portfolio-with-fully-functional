<?php
require 'config/database.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $query = "DELETE FROM portfolio_db.contacts WHERE id = ?";
    $stmt = $pdo->prepare($query);
    if ($stmt->execute([$id])) {
        echo 'success';
    } else {
        echo 'error';
    }
} else {
    echo 'no_id';
}
?>
