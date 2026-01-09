<?php
session_start();

/* 🔐 Access protection */
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'provider') {
    header("Location: ../auth/login.php");
    exit;
}

include "../config/db.php";

/* Fetch provider details */
$provider_id = $_SESSION['provider_id'];

$result = mysqli_query(
    $conn,
    "SELECT name FROM service_providers WHERE provider_id = $provider_id"
);

$provider = mysqli_fetch_assoc($result);
$provider_name = $provider['name'];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Provider Dashboard</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            background-color: #f4f6f9;
        }
        .dashboard-card {
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }
        .dashboard-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.15);
        }
    </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-dark bg-primary px-4">
    <span class="navbar-brand h5 mb-0">
        <i class="bi bi-person-badge"></i> Provider Dashboard
    </span>
    <a href="../auth/logout.php" class="btn btn-light btn-sm">
        <i class="bi bi-box-arrow-right"></i> Logout
    </a>
</nav>

<div class="container mt-5">

    <!-- Welcome -->
    <div class="text-center mb-5">
        <h3>Welcome, <?php echo htmlspecialchars($provider_name); ?> 👋</h3>
        <p class="text-muted">
            Manage your jobs and availability from here
        </p>
    </div>

    <!-- Action Cards -->
    <div class="row g-4">

        <!-- My Jobs -->
        <div class="col-md-6">
            <div class="card dashboard-card h-100">
                <div class="card-body text-center">
                    <i class="bi bi-briefcase-fill fs-1 text-primary"></i>
                    <h5 class="mt-3">My Jobs</h5>
                    <p class="text-muted">
                        View assigned, confirmed, and active jobs
                    </p>
                    <a href="my_jobs.php" class="btn btn-primary w-100">
                        View Jobs
                    </a>
                </div>
            </div>
        </div>

        <!-- Add Availability -->
        <div class="col-md-6">
            <div class="card dashboard-card h-100">
                <div class="card-body text-center">
                    <i class="bi bi-calendar-plus-fill fs-1 text-success"></i>
                    <h5 class="mt-3">Add Availability</h5>
                    <p class="text-muted">
                        Set your available days and time slots
                    </p>
                    <a href="availability.php" class="btn btn-success w-100">
                        Add Availability
                    </a>
                </div>
            </div>
        </div>

    </div>
</div>

</body>
</html>
