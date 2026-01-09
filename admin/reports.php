<?php
include "../config/db.php";

// Jobs per Service Type
$serviceReport = mysqli_query($conn, "
    SELECT service_type, COUNT(*) AS total
    FROM service_requests
    GROUP BY service_type
");

// Request Status Summary
$statusReport = mysqli_query($conn, "
    SELECT status, COUNT(*) AS total
    FROM service_requests
    GROUP BY status
");

// Provider Utilization
$providerReport = mysqli_query($conn, "
    SELECT sp.name, COUNT(a.request_id) AS jobs
    FROM service_providers sp
    LEFT JOIN assignments a ON sp.provider_id = a.provider_id
    GROUP BY sp.provider_id
");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Reports</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <h3 class="mb-4 text-center">
        <i class="bi bi-bar-chart-fill"></i> Admin Reports
    </h3>

    <!-- Jobs per Service Type -->
    <div class="card shadow-sm mb-4">
        <div class="card-header bg-primary text-white">
            <i class="bi bi-tools"></i> Jobs per Service Type
        </div>
        <div class="card-body">
            <table class="table table-bordered mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Service Type</th>
                        <th>Total Jobs</th>
                    </tr>
                </thead>
                <tbody>
                <?php while ($row = mysqli_fetch_assoc($serviceReport)) { ?>
                    <tr>
                        <td><?php echo $row['service_type']; ?></td>
                        <td><?php echo $row['total']; ?></td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Request Status Summary -->
    <div class="card shadow-sm mb-4">
        <div class="card-header bg-warning">
            <i class="bi bi-list-check"></i> Request Status Summary
        </div>
        <div class="card-body">
            <table class="table table-bordered mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Status</th>
                        <th>Count</th>
                    </tr>
                </thead>
                <tbody>
                <?php while ($row = mysqli_fetch_assoc($statusReport)) { ?>
                    <tr>
                        <td>
                            <span class="badge bg-secondary">
                                <?php echo ucfirst($row['status']); ?>
                            </span>
                        </td>
                        <td><?php echo $row['total']; ?></td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Provider Utilization -->
    <div class="card shadow-sm mb-4">
        <div class="card-header bg-success text-white">
            <i class="bi bi-person-lines-fill"></i> Provider Utilization
        </div>
        <div class="card-body">
            <table class="table table-bordered mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Provider Name</th>
                        <th>Jobs Assigned</th>
                    </tr>
                </thead>
                <tbody>
                <?php while ($row = mysqli_fetch_assoc($providerReport)) { ?>
                    <tr>
                        <td><?php echo $row['name']; ?></td>
                        <td><?php echo $row['jobs']; ?></td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

    <div class="text-center">
        <a href="dashboard.php" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Back to Dashboard
        </a>
    </div>
</div>

</body>
</html>
