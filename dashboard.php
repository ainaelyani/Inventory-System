<?php include('layout/header.php');
include('db_connection.php');
include('session_check.php');

$sql = "SELECT COUNT(*) AS total_item FROM inventory";    //total item
$result_total = mysqli_query($conn, $sql);
$row_total = mysqli_fetch_assoc($result_total);
$total_item = $row_total['total_item'];

$sql1 = "SELECT SUM(qty) AS total_stock FROM inventory;";    //total stock
$result_total_stock = mysqli_query($conn,$sql1);
$row_total_stock = mysqli_fetch_assoc($result_total_stock);
$total_stock = $row_total_stock['total_stock'];

$sql2 = "SELECT SUM(qty) AS total_stock_in FROM stock_movement WHERE type ='Stock In'";    //total stock in
$result_total_stock_in = mysqli_query($conn,$sql2);
$row_total_stock_in = mysqli_fetch_assoc($result_total_stock_in);
$total_stock_in = $row_total_stock_in['total_stock_in'];

$sql3 = "SELECT SUM(qty) AS total_stock_out FROM stock_movement WHERE type ='Stock Out'";    //total stock out
$result_total_stock_out = mysqli_query($conn,$sql3);
$row_total_stock_out = mysqli_fetch_assoc($result_total_stock_out);
$total_stock_out = $row_total_stock_out['total_stock_out'];

?>

<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Dashboard</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">The summary of stock and inventory</li>
            </ol>
            <div class="row">
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-primary text-white mb-4">
                        <div class="card-body" style="height: 120px;">
                            <h3>Total Item: <br>
                                <?php echo $total_item ?></h3>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-warning text-white mb-4">
                        <div class="card-body" style="height: 120px;">
                            <h3>Total Stock: <br>
                            <?php echo $total_stock ?></h3>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-success text-white mb-4">
                        <div class="card-body" style="height: 120px;">
                            <h3>Total Stock In: <br>
                            <?php echo $total_stock_in?></h3>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-danger text-white mb-4">
                        <div class="card-body" style="height: 120px;">
                            <h3>Total Stock Out: <br>
                            <?php echo $total_stock_out?></h3>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </main>
    <?php include('layout/footer.php'); ?>