<?php
session_start();
include "../config/db.php";

if (
    isset($_POST['name']) &&
    isset($_POST['service_type']) &&
    isset($_POST['location'])
) {

    $name = $_POST['name'];
    $service_type = $_POST['service_type'];
    $location = $_POST['location'];

    $sql = "INSERT INTO service_providers (name, service_type, location)
            VALUES ('$name', '$service_type', '$location')";

    if (mysqli_query($conn, $sql)) {

        // 🔴 DESTROY OLD SESSION (IMPORTANT)
        session_unset();
        session_destroy();

        // Redirect to fresh login page
        header("Location: ../auth/login.php?registered=1");
        exit;
    } else {
        echo "Error: " . mysqli_error($conn);
    }

} else {
    echo "Waiting for provider data...";
}
?>
