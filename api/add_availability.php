<?php
include "../config/db.php";

if (
    isset($_POST['provider_id']) &&
    isset($_POST['day_of_week']) &&
    isset($_POST['start_time']) &&
    isset($_POST['end_time'])
) {

    $provider_id = $_POST['provider_id'];
    $day_of_week = $_POST['day_of_week'];
    $start_time  = $_POST['start_time'];
    $end_time    = $_POST['end_time'];

    $sql = "INSERT INTO provider_availability 
            (provider_id, day_of_week, start_time, end_time)
            VALUES ($provider_id, $day_of_week, '$start_time', '$end_time')";

    if (mysqli_query($conn, $sql)) {
        header("Location: ../provider/dashboard.php");
        exit;
    }

} 

// Fallback (only if accessed directly)
header("Location: ../provider/dashboard.php");
exit;
