<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <h3 class="mb-4 text-center">Admin Dashboard</h3>

    <div class="row justify-content-center">

        <!-- Service Requests -->
        <div class="col-md-4 mb-4">
            <div class="card shadow-sm text-center h-100">
                <div class="card-body">
                    <i class="bi bi-clipboard-data fs-1 text-primary"></i>
                    <h5 class="card-title mt-3">Service Requests</h5>
                    <p class="card-text">
                        View all customer service requests.
                    </p>
                    <a href="view_requests.php" class="btn btn-primary">
                        View Requests
                    </a>
                </div>
            </div>
        </div>

        <!-- Match Providers -->
        <div class="col-md-4 mb-4">
            <div class="card shadow-sm text-center h-100">
                <div class="card-body">
                    <i class="bi bi-search fs-1 text-warning"></i>
                    <h5 class="card-title mt-3">Match Providers</h5>
                    <p class="card-text">
                        Find and assign providers to service requests.
                    </p>
                    <a href="view_requests.php" class="btn btn-warning">
                        Match Providers
                    </a>
                </div>
            </div>
        </div>

        <!-- Reports -->
        <div class="col-md-4 mb-4">
            <div class="card shadow-sm text-center h-100">
                <div class="card-body">
                    <i class="bi bi-bar-chart-line fs-1 text-success"></i>
                    <h5 class="card-title mt-3">Reports</h5>
                    <p class="card-text">
                        View analytics and system performance reports.
                    </p>
                    <a href="reports.php" class="btn btn-success">
                        View Reports
                    </a>
                </div>
            </div>
        </div>

    </div>
</div>

</body>
</html>
