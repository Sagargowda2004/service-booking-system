<?php
include "../config/db.php";

if (
    isset($_POST['service_type']) &&
    isset($_POST['requested_date']) &&
    isset($_POST['time_window']) &&
    isset($_POST['customer_location'])
) {

    $service_type      = $_POST['service_type'];
    $requested_date    = $_POST['requested_date'];
    $time_window       = $_POST['time_window']; // morning / afternoon / evening
    $customer_location = $_POST['customer_location'];

    $sql = "INSERT INTO service_requests 
            (service_type, requested_date, time_window, customer_location, status)
            VALUES 
            ('$service_type', '$requested_date', '$time_window', '$customer_location', 'open')";

    if (mysqli_query($conn, $sql)) {
        // ✅ Redirect to success page
        header("Location: ../customer/request_success.php");
        exit;
    } else {
        // Only for debugging (not shown in normal flow)
        echo "Database Error: " . mysqli_error($conn);
    }

} else {
    // Accessed directly without form submit
    header("Location: ../customer/request_service.php");
    exit;
}
?>
