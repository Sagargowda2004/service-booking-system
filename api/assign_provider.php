<?php
include "../config/db.php";

if (
    isset($_POST['request_id']) &&
    isset($_POST['provider_id'])
) {

    $request_id  = $_POST['request_id'];
    $provider_id = $_POST['provider_id'];

    // Insert assignment
    $sql = "INSERT INTO assignments (request_id, provider_id)
            VALUES ($request_id, $provider_id)";

    if (mysqli_query($conn, $sql)) {

        // Update request status to assigned
        mysqli_query(
            $conn,
            "UPDATE service_requests 
             SET status='assigned' 
             WHERE request_id=$request_id"
        );

        // ✅ Redirect admin back to requests list
        header("Location: ../admin/view_requests.php");
        exit;

    } else {
        echo "Database Error: " . mysqli_error($conn);
    }

} else {
    // Accessed incorrectly
    header("Location: ../admin/dashboard.php");
    exit;
}
?>
