<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - WeCare Clinic</title>
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

    .hero-section {
        background: rgba(0, 0, 0, 0.5);
        color: white;
        padding: 100px 0;
        text-align: center;
        background-image: url('clinic.jpg');
        background-size: cover;
        background-position: center;
    }

    .hero-section h1 {
        font-size: 3em;
        font-weight: bold;
    }

    .hero-section p {
        font-size: 1.5em;
        margin-top: 10px;
    }

    .services-section {
        padding: 50px 0;
    }

    .service-card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .service-card:hover {
        transform: scale(1.05);
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
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
        <div class="hero-section">
            <div class="container">
                <h1>Welcome to WeCare Clinic</h1>
                <p>Your Health, Our Priority</p>
                <a href="service.php" class="btn btn-primary btn-lg mt-4">Explore Our Services</a>
            </div>
        </div>

        <div class="services-section">
            <div class="container">
                <h2 class="text-center mb-4">Our Services</h2>
                <div class="row">
                    <div class="col-md-4 mb-4">
                        <div class="card service-card">
                            <div class="card-body text-center">
                                <i class="fas fa-stethoscope fa-3x mb-3 text-primary"></i>
                                <h5 class="card-title">General Checkup</h5>
                                <p class="card-text">Comprehensive health checkups to ensure your well-being.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-4">
                        <div class="card service-card">
                            <div class="card-body text-center">
                                <i class="fas fa-notes-medical fa-3x mb-3 text-success"></i>
                                <h5 class="card-title">Diagnostic Tests</h5>
                                <p class="card-text">Offering a diverse variety of diagnostic tests.</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 mb-4">
                        <div class="card service-card">
                            <div class="card-body text-center">
                                <i class="fas fa-plane fa-3x mb-3 text-info"></i>
                                <h5 class="card-title">Travel Medicine</h5>
                                <p class="card-text">Comprehensive consultations and vaccinations for travel
                                    experiences.
                                </p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
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
