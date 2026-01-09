<?php
session_start();

/* 🔐 Protect page */
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'provider') {
    header("Location: ../auth/login.php");
    exit;
}

include "../config/db.php";

$provider_id = $_SESSION['provider_id'];
$success = "";
$error = "";

/* Handle form submit */
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $day_of_week = $_POST['day_of_week'] ?? '';
    $start_time  = $_POST['start_time'] ?? '';
    $end_time    = $_POST['end_time'] ?? '';

    if ($day_of_week && $start_time && $end_time) {

        $sql = "
        INSERT INTO provider_availability
        (provider_id, day_of_week, start_time, end_time)
        VALUES
        ($provider_id, '$day_of_week', '$start_time', '$end_time')
        ";

        if (mysqli_query($conn, $sql)) {
            $success = "Availability added successfully";
        } else {
            $error = "Database error: " . mysqli_error($conn);
        }

    } else {
        $error = "All fields are required";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Availability</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            background-color: #f4f6f9;
        }
    </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-dark bg-primary px-4">
    <span class="navbar-brand h5 mb-0">
        <i class="bi bi-calendar-plus"></i> Add Availability
    </span>
    <a href="dashboard.php" class="btn btn-light btn-sm">
        <i class="bi bi-arrow-left"></i> Back
    </a>
</nav>

<div class="container mt-5" style="max-width:500px">

    <?php if ($success != "") { ?>
        <div class="alert alert-success text-center">
            <?php echo $success; ?>
        </div>
    <?php } ?>

    <?php if ($error != "") { ?>
        <div class="alert alert-danger text-center">
            <?php echo $error; ?>
        </div>
    <?php } ?>

    <div class="card shadow-sm">
        <div class="card-body">
            <h5 class="text-center mb-4">Set Your Availability</h5>

            <form method="POST">

                <!-- Day -->
                <div class="mb-3">
                    <label class="form-label">Day of Week</label>
                    <select name="day_of_week" class="form-control" required>
                        <option value="">Select Day</option>
                        <option value="Monday">Monday</option>
                        <option value="Tuesday">Tuesday</option>
                        <option value="Wednesday">Wednesday</option>
                        <option value="Thursday">Thursday</option>
                        <option value="Friday">Friday</option>
                        <option value="Saturday">Saturday</option>
                        <option value="Sunday">Sunday</option>
                    </select>
                </div>

                <!-- Time -->
                <div class="mb-3">
                    <label class="form-label">Start Time</label>
                    <input type="time" name="start_time" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">End Time</label>
                    <input type="time" name="end_time" class="form-control" required>
                </div>

                <button class="btn btn-success w-100">
                    <i class="bi bi-save"></i> Save Availability
                </button>

            </form>
        </div>
    </div>
</div>

</body>
</html>
