<?php include('layout/header.php');
include('db_connection.php');
include('session_check.php');

$query = "SELECT * FROM category";
$result = mysqli_query($conn, $query);

$inventory_id = $_GET['id'];
$query = "SELECT
	inventory.id,
    inventory.sn_no,
    inventory.item_name,
    inventory.item_desc,
    inventory.img,
    inventory.qty,
    inventory.created_at,
    inventory.category_id,
    category.name AS category_name
FROM
	inventory
JOIN
	category ON inventory.category_id=category.id
    WHERE inventory.id=" . $inventory_id;

$result2 = mysqli_query($conn, $query);
$inventory_data = mysqli_fetch_assoc($result2);
?>

<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <form class=mt-3 method='POST' action="submit_edited_inventory.php" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?php echo htmlspecialchars($inventory_data['id']); ?>">

                <div class="mb-2">
                    <label for="Sn No" class="form-label">SN No</label>
                    <input type="text" class="form-control" id="snNO" name="sn_no" placeholder="Enter SN no of item"
                        value="<?php echo htmlspecialchars($inventory_data['sn_no']); ?>" required>
                </div>
                <div class="mb-2">
                    <label for="itemName" class="form-label">Item Name</label>
                    <input type="text" class="form-control" id="itemName" name="item_name" placeholder="Enter item name"
                        value="<?php echo htmlspecialchars($inventory_data['item_name']); ?>" required>
                </div>
                <div class="mb-2">
                    <label for="itemDesc">Item Description</label>
                    <textarea class="form-control" name="item_desc" id="itemDesc" required>
                        <?php echo htmlspecialchars($inventory_data['item_desc']); ?></textarea>
                    </textarea>
                </div>
                <div class="mb-2">
                    <label for="img">Item Img</label>
                    <input type="file" id="img" name="img" accept="image/*">
                    <p>Current image:<img src="<?php echo htmlspecialchars($inventory_data['img']); ?>" alt="img" width="10%"></p>
                </div>
                <div class="mb-2">
                    <label for="itemQty" class="form-label">Item Qty</label>
                    <input type="number" class="form-control" id="itemQty" name="qty" placeholder="Enter quantity"
                        value="<?php echo htmlspecialchars($inventory_data['qty']); ?>" required>
                </div>
                <div class="mb-2">
                    <label for="category" class="form-label">Item Category</label>
                    <select name="category_id" class="form-control" required>
                        <option value="<?php echo htmlspecialchars($inventory_data['category_id']); ?>"><?php echo htmlspecialchars($inventory_data['category_name']); ?>
                        </option>
                        <?php
                        while ($row = mysqli_fetch_assoc($result)) {
                            $selected = ($inventory_data['category_id'] == $row['id']) ? 'selected' : '';
                            echo '<option value=' . $row['id'] . '' . $selected . '>' . htmlspecialchars($row['name']) . '</option>';
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