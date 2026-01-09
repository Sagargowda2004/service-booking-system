<?php
include "../config/db.php";

echo "<h2>Admin Reports</h2>";

/* 1. Jobs per service type */
echo "<h3>Jobs per Service Type</h3>";
$sql1 = "SELECT service_type, COUNT(*) AS total_jobs 
         FROM service_requests 
         GROUP BY service_type";
$result1 = mysqli_query($conn, $sql1);

while ($row = mysqli_fetch_assoc($result1)) {
    echo $row['service_type'] . " : " . $row['total_jobs'] . "<br>";
}

/* 2. Pending vs Completed Requests */
echo "<h3>Request Status Summary</h3>";
$sql2 = "SELECT status, COUNT(*) AS count 
         FROM service_requests 
         GROUP BY status";
$result2 = mysqli_query($conn, $sql2);

while ($row = mysqli_fetch_assoc($result2)) {
    echo $row['status'] . " : " . $row['count'] . "<br>";
}

/* 3. Provider Utilization */
echo "<h3>Provider Utilization</h3>";
$sql3 = "
SELECT sp.name, COUNT(a.assignment_id) AS jobs_assigned
FROM service_providers sp
LEFT JOIN assignments a ON sp.provider_id = a.provider_id
GROUP BY sp.provider_id
";

$result3 = mysqli_query($conn, $sql3);

while ($row = mysqli_fetch_assoc($result3)) {
    echo $row['name'] . " : " . $row['jobs_assigned'] . " jobs<br>";
}
?>
