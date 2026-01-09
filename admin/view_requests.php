<?php
include "../config/db.php";

$sql = "SELECT * FROM service_requests WHERE status = 'open'";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Service Requests</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <h3 class="mb-4 text-center">Open Service Requests</h3>

    <?php if (mysqli_num_rows($result) == 0) { ?>
        <div class="alert alert-info text-center">
            No open service requests
        </div>
    <?php } else { ?>

    <div class="table-responsive">
        <table class="table table-bordered table-hover align-middle">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Service</th>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Location</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>

            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                <tr>
                    <td><?php echo $row['request_id']; ?></td>
                    <td>
                        <i class="bi bi-tools text-primary"></i>
                        <?php echo $row['service_type']; ?>
                    </td>
                    <td><?php echo $row['requested_date']; ?></td>
                    <td><?php echo ucfirst($row['time_window']); ?></td>
                    <td><?php echo $row['customer_location']; ?></td>
                    <td>
                        <span class="badge bg-warning text-dark">
                            <?php echo ucfirst($row['status']); ?>
                        </span>
                    </td>
                    <td>
                        <a href="match.php?request_id=<?php echo $row['request_id']; ?>"
                           class="btn btn-sm btn-primary">
                            <i class="bi bi-search"></i> Match Providers
                        </a>
                    </td>
                </tr>
            <?php } ?>

            </tbody>
        </table>
    </div>

    <?php } ?>

    <a href="dashboard.php" class="btn btn-secondary mt-3">
        <i class="bi bi-arrow-left"></i> Back to Dashboard
    </a>
</div>

</body>
</html>
