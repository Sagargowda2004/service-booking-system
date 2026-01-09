<!DOCTYPE html>
<?php
$error = isset($_GET['error']);
?>

<html>
<head>
    <title>Provider Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5" style="max-width: 420px;">
    <h3 class="mb-4 text-center">Provider Login</h3>
    <?php if ($error): ?>
    <div class="alert alert-danger text-center">
        Invalid provider name or service type
    </div>
<?php endif; ?>


    <form method="POST" action="dashboard.php">

        <div class="mb-3">
            <label class="form-label">Provider Name</label>
            <input type="text" name="name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Service Type</label>
            <select name="service_type" class="form-control" required>
                <option value="">Select Service</option>
                <option value="Plumber">Plumber</option>
                <option value="Electrician">Electrician</option>
                <option value="Carpenter">Carpenter</option>
                <option value="Mechanic">Mechanic</option>
                <option value="Painter">Painter</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary w-100">
            Login
        </button>
    </form>

    <!-- 🔹 REGISTER LINK -->
    <div class="text-center mt-3">
        <span>New provider?</span>
        <a href="register.php" class="fw-bold">Register here</a>
    </div>
</div>

</body>
</html>
