<?php
session_start();
include "../config/db.php";

if (
    isset($_SESSION['provider_id']) &&
    isset($_POST['request_id'])
) {

    $provider_id = $_SESSION['provider_id'];
    $request_id  = $_POST['request_id'];

    // Ensure this job belongs to this provider
    $check = mysqli_query(
        $conn,
        "SELECT * FROM assignments 
         WHERE request_id = $request_id 
         AND provider_id = $provider_id"
    );

    if (mysqli_num_rows($check) == 1) {

        // Update request status to CLOSED
        mysqli_query(
            $conn,
            "UPDATE service_requests 
             SET status = 'closed'
             WHERE request_id = $request_id"
        );

        // Redirect back to provider jobs
        header("Location: ../provider/my_jobs.php");
        exit;

    } else {
        // Unauthorized close attempt
        header("Location: ../provider/my_jobs.php");
        exit;
    }

} else {
    header("Location: ../provider/login.php");
    exit;
}
?>
