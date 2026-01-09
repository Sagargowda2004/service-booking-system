<?php
include "../config/db.php";

$request_id = $_GET['request_id'];

// Fetch request details
$request = mysqli_fetch_assoc(
    mysqli_query($conn, "SELECT * FROM service_requests WHERE request_id = $request_id")
);

// Fetch matching providers
// ✅ Exclude ONLY providers who have ACTIVE jobs (assigned / confirmed)
// ✅ Allow providers whose jobs are CLOSED
$sql = "
SELECT sp.provider_id, sp.name, sp.service_type, sp.location
FROM service_providers sp
JOIN provider_availability pa 
    ON sp.provider_id = pa.provider_id
WHERE sp.service_type = '{$request['service_type']}'
AND sp.location = '{$request['customer_location']}'
AND sp.provider_id NOT IN (
    SELECT a.provider_id
    FROM assignments a
    JOIN service_requests sr 
        ON a.request_id = sr.request_id
    WHERE sr.requested_date = '{$request['requested_date']}'
    AND sr.time_window = '{$request['time_window']}'
    AND sr.status IN ('assigned', 'confirmed')
)
";

$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Match Providers</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">

    <h3 class="mb-4 text-center">
        <i class="bi bi-search"></i> Match Providers
    </h3>

    <!-- Request Summary -->
    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <h5 class="card-title">Service Request Details</h5>
            <p class="mb-1"><strong>Service:</strong> <?php echo $request['service_type']; ?></p>
            <p class="mb-1"><strong>Date:</strong> <?php echo $request['requested_date']; ?></p>
            <p class="mb-1"><strong>Time:</strong> <?php echo ucfirst($request['time_window']); ?></p>
            <p class="mb-0"><strong>Location:</strong> <?php echo $request['customer_location']; ?></p>
        </div>
    </div>

    <!-- Providers -->
    <?php if (mysqli_num_rows($result) == 0) { ?>
        <div class="alert alert-warning text-center">
            <i class="bi bi-exclamation-circle"></i>
            No matching providers available for this time slot
        </div>
    <?php } else { ?>

        <div class="row">
            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                <div class="col-md-4 mb-4">
                    <div class="card shadow-sm h-100">
                        <div class="card-body text-center">
                            <i class="bi bi-person-circle fs-1 text-primary"></i>
                            <h5 class="mt-2"><?php echo $row['name']; ?></h5>

                            <p class="mb-1">
                                <strong>Service:</strong> <?php echo $row['service_type']; ?>
                            </p>
                            <p class="mb-3">
                                <strong>Location:</strong> <?php echo $row['location']; ?>
                            </p>

                            <form method="POST" action="../api/assign_provider.php">
                                <input type="hidden" name="request_id" value="<?php echo $request_id; ?>">
                                <input type="hidden" name="provider_id" value="<?php echo $row['provider_id']; ?>">
                                <button class="btn btn-success w-100">
                                    <i class="bi bi-check-circle"></i> Assign Provider
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>

    <?php } ?>

    <div class="text-center mt-3">
        <a href="view_requests.php" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Back to Requests
        </a>
    </div>

</div>

</body>
</html>
