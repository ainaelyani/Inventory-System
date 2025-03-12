<?php include('layout/header.php');
include('session_check.php');

?>

<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <form class=mt-3 method='POST' action="category_in_save.php">
                <div class="mb-2">
                    <label for="id" class="form-label">Category Name:</label>
                    <input type="text" name="name" class="form-control" required>
                </div>

                <button type="submit" class="btn btn-primary">Submit</button>
            </form>

        </div>
    </main>
</div>
<?php include('layout/footer.php'); ?>