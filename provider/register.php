<!DOCTYPE html>
<html>
<head>
    <title>Provider Registration</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <h3 class="mb-4">Provider Registration</h3>

    <form method="POST" action="../api/add_provider.php">

        <!-- Provider Name -->
        <div class="mb-3">
            <label class="form-label">Provider Name</label>
            <input type="text" name="name" class="form-control" placeholder="Enter name" required>
        </div>

        <!-- Service Type Dropdown -->
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

        <!-- Location Dropdown -->
        <div class="mb-3">
            <label class="form-label">Location</label>
            <select name="location" class="form-control" required>
                <option value="">Select Location</option>
                <option value="Mysore">Mysore</option>
                <option value="Bangalore">Bangalore</option>
                <option value="Mandya">Mandya</option>
                <option value="Hassan">Hassan</option>
                <option value="Tumkur">Tumkur</option>
            </select>
        </div>

        <!-- Submit -->
        <button type="submit" class="btn btn-primary w-100">
            Register Provider
        </button>

    </form>
</div>

</body>
</html>
