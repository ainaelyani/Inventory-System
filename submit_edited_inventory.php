<?php
include('db_connection.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $id = $_POST['id'];
    $sn_no = mysqli_real_escape_string($conn, $_POST['sn_no']);
    $item_name = mysqli_real_escape_string($conn, $_POST['item_name']);
    $item_desc = mysqli_real_escape_string($conn, $_POST['item_desc']);
    $qty = intval($_POST['qty']);
    $category_id = intval($_POST['category_id']);
    $img = $_FILES['img'];

    if ($img['size'] > 0) {
        $target_dir = "upload/";
        $target_file = $target_dir . basename($img['name']);
        move_uploaded_file($img['tmp_name'], $target_file);
        $img_path = mysqli_real_escape_string($conn, $target_file);
        $img_query = ", img='$img_path'";
    } else {
        $img_query = '';
    }

    $update_query = "
        UPDATE inventory
        SET 
            sn_no='$sn_no',
            item_name='$item_name',
            item_desc='$item_desc',
            qty=$qty,
            category_id=$category_id
            $img_query
        WHERE id='$id';
    ";

    if (mysqli_query($conn, $update_query)) {
        // Redirect to inventory page on success
        header("Location: /inventory-system/inventory.php?update=success");
        exit;
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}


?>
