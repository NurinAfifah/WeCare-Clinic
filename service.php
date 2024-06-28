<?php
session_start();
require_once 'dbconnect.php';

$sql = "SELECT * FROM tbl_services";
$stmt = $conn->query($sql);  // PDO::query() method

$services = [];
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $services[$row['service_title']][] = $row;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Services - WeCare Clinic</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
    body {
        background: url('background.png') no-repeat center center fixed;
        background-size: cover;
        margin: 0;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        display: flex;
        flex-direction: column;
        min-height: 100vh;
    }

    .content-wrapper {
        flex: 1;
        padding: 20px;
        padding-top: 70px;
    }

    .card {
        border: none;
        border-radius: 10px;
        overflow: hidden;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        margin-bottom: 20px;
    }

    .card:hover {
        transform: scale(1.05);
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
    }

    .card-body {
        background-color: rgba(255, 255, 255, 0.9);
        padding: 20px;
        text-align: center;
    }

    .card-title {
        font-size: 1.5em;
        font-weight: bold;
        color: #007bff;
        text-align: left;
        margin-bottom: 10px;
        /* Added margin bottom for spacing */
    }

    .card-text {
        font-size: 1em;
        color: #333333;
        text-align: left;
    }

    .service-price {
        font-size: 1.2em;
        font-weight: bold;
        color: #28a745;
    }

    .footer {
        background-color: rgba(255, 255, 255, 0.9);
        padding: 10px 0;
        text-align: center;
        width: 100%;
        box-shadow: 0 -1px 5px rgba(0, 0, 0, 0.1);
    }

    .footer .container {
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .footer .text-muted {
        color: #6c757d;
    }
    </style>
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <div class="container">
            <a class="navbar-brand" href="#">WeCare Clinic</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="home.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="service.php">Services</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="login.php">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="content-wrapper">
        <div class="container">
            <?php foreach ($services as $title => $serviceGroup): ?>
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title"><?php echo $title; ?></h3>
                    <ul class="list-group list-group-flush">
                        <?php foreach ($serviceGroup as $service): ?>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span><?php echo $service['service_name']; ?></span>
                            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal"
                                data-target="#serviceModal<?php echo $service['service_id']; ?>">
                                View Details
                            </button>
                        </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
            <?php endforeach; ?>

            <?php foreach ($services as $serviceGroup): ?>
            <?php foreach ($serviceGroup as $service): ?>
            <div class="modal fade" id="serviceModal<?php echo $service['service_id']; ?>" tabindex="-1"
                aria-labelledby="serviceModalLabel<?php echo $service['service_id']; ?>" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="serviceModalLabel<?php echo $service['service_id']; ?>">
                                <?php echo $service['service_name']; ?></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <p><?php echo $service['service_description']; ?></p>
                            <p class="service-price">RM <?php echo $service['service_price']; ?></p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
            <?php endforeach; ?>
        </div>
    </div>

    <footer class="footer">
        <div class="container">
            <span class="text-muted">© 2024 WeCare Clinic. All rights reserved.</span>
        </div>
    </footer>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
