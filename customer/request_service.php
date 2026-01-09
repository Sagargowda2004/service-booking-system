<!DOCTYPE html>
<html>
<head>
    <title>Request a Service</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5" style="max-width: 500px;">
    <h3 class="mb-4 text-center">
        <i class="bi bi-person-fill"></i> Request a Service
    </h3>

    <form method="POST" action="../api/add_request.php">

        <!-- Service Type -->
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

        <!-- Preferred Date -->
        <div class="mb-3">
            <label class="form-label">Preferred Date</label>
            <input type="date" name="requested_date" class="form-control" required>
        </div>

        <!-- Time Window -->
        <div class="mb-3">
            <label class="form-label">Time Window</label>
            <select name="time_window" class="form-control" required>
                <option value="morning">Morning (8 AM – 12 PM)</option>
                <option value="afternoon">Afternoon (12 PM – 4 PM)</option>
                <option value="evening">Evening (4 PM – 8 PM)</option>
            </select>
        </div>

        <!-- Location -->
        <div class="mb-3">
            <label class="form-label">Location</label>
            <select name="customer_location" class="form-control" required>
                <option value="">Select Location</option>
                <option value="Mysore">Mysore</option>
                <option value="Bangalore">Bangalore</option>
                <option value="Mandya">Mandya</option>
                <option value="Hassan">Hassan</option>
                <option value="Tumkur">Tumkur</option>
            </select>
        </div>

        <!-- Submit -->
        <button type="submit" class="btn btn-success w-100">
            <i class="bi bi-send"></i> Submit Request
        </button>
    </form>
</div>

</body>
</html>
