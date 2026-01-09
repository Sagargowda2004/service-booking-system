<?php
session_start();

/* 🔐 Protect page */
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'provider') {
    header("Location: ../auth/login.php");
    exit;
}

include "../config/db.php";

$provider_id = $_SESSION['provider_id'];

/* Fetch jobs assigned to this provider */
$sql = "
SELECT sr.*
FROM assignments a
JOIN service_requests sr ON a.request_id = sr.request_id
WHERE a.provider_id = $provider_id
ORDER BY sr.requested_date DESC
";

$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>My Jobs</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            background-color: #f4f6f9;
        }
        .job-card {
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }
        .job-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.15);
        }
    </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-dark bg-primary px-4">
    <span class="navbar-brand h5 mb-0">
        <i class="bi bi-briefcase"></i> My Jobs
    </span>
    <a href="dashboard.php" class="btn btn-light btn-sm">
        <i class="bi bi-arrow-left"></i> Back
    </a>
</nav>

<div class="container mt-5">

    <?php if (mysqli_num_rows($result) == 0) { ?>
        <div class="alert alert-info text-center">
            <i class="bi bi-info-circle"></i> No jobs assigned yet
        </div>
    <?php } else { ?>

        <div class="row g-4">
            <?php while ($job = mysqli_fetch_assoc($result)) { ?>

                <div class="col-md-6">
                    <div class="card job-card h-100">
                        <div class="card-body">

                            <h5 class="card-title">
                                <?php echo $job['service_type']; ?>
                            </h5>

                            <p class="mb-1">
                                <strong>Date:</strong> <?php echo $job['requested_date']; ?>
                            </p>
                            <p class="mb-1">
                                <strong>Time:</strong> <?php echo ucfirst($job['time_window']); ?>
                            </p>
                            <p class="mb-2">
                                <strong>Location:</strong> <?php echo $job['customer_location']; ?>
                            </p>

                            <!-- Status Badge -->
                            <?php
                            $status = $job['status'];
                            $badge = "secondary";

                            if ($status === "assigned") $badge = "warning";
                            if ($status === "confirmed") $badge = "primary";
                            if ($status === "closed") $badge = "success";
                            ?>

                            <span class="badge bg-<?php echo $badge; ?>">
                                <?php echo ucfirst($status); ?>
                            </span>

                            <!-- Actions -->
                            <div class="mt-3">

                                <?php if ($status === "assigned") { ?>
                                    <form method="POST" action="../api/confirm_job.php">
                                        <input type="hidden" name="request_id" value="<?php echo $job['request_id']; ?>">
                                        <button class="btn btn-success w-100">
                                            <i class="bi bi-check-circle"></i> Confirm Job
                                        </button>
                                    </form>
                                <?php } ?>

                                <?php if ($status === "confirmed") { ?>
                                    <form method="POST" action="../api/close_job.php">
                                        <input type="hidden" name="request_id" value="<?php echo $job['request_id']; ?>">
                                        <button class="btn btn-danger w-100">
                                            <i class="bi bi-x-circle"></i> Close Job
                                        </button>
                                    </form>
                                <?php } ?>

                                <?php if ($status === "closed") { ?>
                                    <div class="text-success text-center mt-2">
                                        <i class="bi bi-check2-circle"></i> Job Completed
                                    </div>
                                <?php } ?>

                            </div>

                        </div>
                    </div>
                </div>

            <?php } ?>
        </div>

    <?php } ?>

</div>

</body>
</html>
