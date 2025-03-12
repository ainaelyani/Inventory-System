<?php include('layout/header.php');
include('db_connection.php'); 
include('session_check.php');

$query= "SELECT * FROM category";
$result=mysqli_query($conn,$query);
?>

<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <form class=mt-3 method='POST' action="submit_inventory.php" enctype="multipart/form-data"> 
                <div class="mb-2">
                    <label for="Sn No" class="form-label">SN No</label>
                    <input type="text" class="form-control" id="snNO" name="sn_no" placeholder="Enter SN no of item" required>
                </div>
                <div class="mb-2">
                    <label for="itemName" class="form-label">Item Name</label>
                    <input type="text" class="form-control" id="itemName" name="item_name" placeholder="Enter item name" required>
                </div>
                <div class="mb-2">
                    <label for="itemDesc">Item Description</label>
                    <textarea class="form-control" name="item_desc" id="itemDesc"></textarea>
                </div>
                <div class="mb-2">
                    <label for="img">Item Img</label>
                    <input type="file" id="img" name="img" accept="image/*">
                </div>
                <div class="mb-2">
                    <label for="itemQty" class="form-label">Item Qty</label>
                    <input type="number" class="form-control" id="itemQty" name="qty" placeholder="Enter quantity" required>
                </div>
                <div class="mb-2">
                    <label for="category" class="form-label">Item Category</label>
                    <select name="category_id" class="form-control" required>
                        <option value="">Select category</option>
                        <?php 
                            while ($row=mysqli_fetch_assoc($result)){
                                echo '<option value='.$row['id']. '>' .htmlspecialchars($row['name']).'</option>';
                            }
                        ?>
                    </select>
                </div>
      
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>

        </div>
    </main>
</div>
<?php include('layout/footer.php'); ?>