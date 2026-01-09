<?php
session_start();
include "../config/db.php";

/* ✅ Initialize error variable */
$error = "";

/* Handle login */
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $role = $_POST['role'] ?? '';

    // 🔹 ADMIN LOGIN
    if ($role === 'admin') {
        $_SESSION['role'] = 'admin';
        header("Location: ../index.php");
        exit;
    }

    // 🔹 PROVIDER LOGIN
    if ($role === 'provider') {
        $name = trim($_POST['name'] ?? '');

        if ($name === "") {
            $error = "Please enter provider name";
        } else {
            $res = mysqli_query(
                $conn,
                "SELECT * FROM service_providers WHERE name='$name'"
            );

            if (mysqli_num_rows($res) === 1) {
                $provider = mysqli_fetch_assoc($res);
                $_SESSION['role'] = 'provider';
                $_SESSION['provider_id'] = $provider['provider_id'];
                $_SESSION['provider_name'] = $provider['name'];
                header("Location: ../index.php");
                exit;
            } else {
                $error = "Provider not found. Please register first.";
            }
        }
    }

    // 🔹 CUSTOMER LOGIN (Guest)
    if ($role === 'customer') {
        $_SESSION['role'] = 'customer';
        header("Location: ../index.php");
        exit;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Central Login</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            min-height: 100vh;
            background:
                linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.6)),
                url("../assets/images/service_bg.jpg") no-repeat center center/cover;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .login-card {
            background: #ffffff;
            padding: 30px;
            border-radius: 10px;
            width: 100%;
            max-width: 420px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.3);
        }
    </style>
</head>
<body>

<div class="login-card">
    <h3 class="text-center mb-4">Login</h3>

    <?php if ($error !== "") { ?>
        <div class="alert alert-danger text-center">
            <?php echo $error; ?>
        </div>
    <?php } ?>

    <form method="POST">

        <!-- Role -->
        <div class="mb-3">
            <label class="form-label">Login As</label>
            <select name="role" id="role" class="form-control" required>
                <option value="">Select Role</option>
                <option value="admin">Admin</option>
                <option value="provider">Provider</option>
                <option value="customer">Customer</option>
            </select>
        </div>

        <!-- Provider Name -->
        <div class="mb-3" id="providerField" style="display:none;">
            <label class="form-label">Provider Name</label>
            <input type="text" name="name" class="form-control" placeholder="Enter provider name">
        </div>

        <button class="btn btn-primary w-100">Login</button>
    </form>

    <!-- 🔹 Provider Registration Link -->
    <div class="text-center mt-3" id="registerLink" style="display:none;">
        <p class="mb-0">
            New Provider?
            <a href="../provider/register.php" class="fw-bold">
                Create an account
            </a>
        </p>
    </div>
</div>

<script>
    const roleSelect = document.getElementById("role");
    const providerField = document.getElementById("providerField");
    const registerLink = document.getElementById("registerLink");

    roleSelect.addEventListener("change", function () {
        if (this.value === "provider") {
            providerField.style.display = "block";
            registerLink.style.display = "block";
        } else {
            providerField.style.display = "none";
            registerLink.style.display = "none";
        }
    });
</script>

</body>
</html>
