<?php
include('db_connection.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE email = '$email'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) == 1) { //unique email 
        $user = mysqli_fetch_assoc($result);

        if ($password == $user['password']) { // Verify the password
            session_start(); //if password is correct
            // Set session variables for the logged-in user
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['email'] = $user['email'];

            header("Location: /inventory-system/dashboard.php");
            exit();
        } else {
            header("Location: /inventory-system");
        }
    } else {
        header("Location:/inventory-system");
    }
}
mysqli_close($conn);
?>
