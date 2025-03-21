<?php
include('db_connection.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = intval($_POST['id']); // Convert to an integer for safety
    $new_qty = intval($_POST['qty']); // The quantity to add
    $type = "Stock Out";

    // Select query to get inventory details
    $query = "
        SELECT 
            inventory.id,
            inventory.sn_no,
            inventory.item_name,
            inventory.item_desc,
            inventory.qty
        FROM 
            inventory
        WHERE 
            inventory.id = $id;
    ";
    $result = mysqli_query($conn, $query);


    if ($items = mysqli_fetch_assoc($result)) {
      
        $sn_no = $items['sn_no'];
        $item_name = $items['item_name'];
        $item_desc = $items['item_desc'];
        $current_qty = $items['qty']; //qty dkt database

        if ($current_qty < $new_qty) {
            header("Location: /inventory-system/stock-out.php?alert=insufficient");
            exit(); 
        }

        $sql = "
        INSERT INTO stock_movement (type, sn_no, item_name, item_desc, qty)
        VALUES ('$type', '$sn_no', '$item_name', '$item_desc', $new_qty);"; //qty update

        if (mysqli_query($conn, $sql)) {

            $updated_qty = $current_qty - $new_qty;
            $update_query = "
            UPDATE inventory 
            SET qty = $updated_qty 
            WHERE id = $id;";

            if (mysqli_query($conn, $update_query)) {
                header("Location: /inventory-system/stock-movement.php");
            } else {
                echo "Error updating inventory: " . mysqli_error($conn);
            }
        } else {
            echo "Error inserting into stock_movement: " . mysqli_error($conn);
        }
    } else {
        echo "Item not found.";
    }

    // Close the database connection
    mysqli_close($conn);
}
