<?php
include('db_connection.php'); 

$id = $_GET['id'];
$query = "DELETE FROM inventory WHERE id='$id'";

if (mysqli_query($conn, $query)) {
    // Redirect to inventory page on success
    header("Location: /inventory-system/inventory.php?update=delete");
    exit;
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

?>
