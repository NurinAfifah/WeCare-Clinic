<?php
session_start();

if (isset($_POST['username']) && isset($_POST['password'])) {
    // Include the database connection file
    require_once 'dbconnect.php';

    $username = $_POST['username'];
    $password = $_POST['password'];

    $sqllogin = "SELECT * FROM `users` WHERE `name` = :username";
    $stmt = $conn->prepare($sqllogin);
    $stmt->bindParam(':username', $username);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        if (password_verify($password, $user['password'])) {
            $_SESSION["name"] = $username;
            echo "<script>alert('Login Success');</script>";
            echo "<script>window.location.href = 'index.php';</script>";
        } else {
            echo "<script>alert('Login Failed: Incorrect password');</script>";
            echo "<script>window.location.href = 'login.php';</script>";
        }
    } else {
        echo "<script>alert('Login Failed: User not found');</script>";
        echo "<script>window.location.href = 'login.php';</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - WeCare Clinic</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
    body {
        background: url('background.png') no-repeat center center fixed;
        background-size: cover;
        margin: 0;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        display: flex;
        align-items: center;
        justify-content: center;
        min-height: 100vh;
        padding: 20px;
    }

    .split-screen {
        display: flex;
        max-width: 900px;
        width: 100%;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        border-radius: 10px;
        background-color: rgba(255, 255, 255, 0.9);
        /* Slightly transparent white */
    }

    .split-screen .left,
    .split-screen .right {
        flex: 1;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 100px;
    }

    .split-screen .left {
        background: url('wecare1.png') no-repeat center center;
        background-size: cover;
        border-top-left-radius: 10px;
        border-bottom-left-radius: 10px;
    }

    .split-screen .right {
        flex-direction: column;
        justify-content: center;
        border-top-right-radius: 10px;
        border-bottom-right-radius: 10px;
    }

    .right .form-container {
        width: 100%;
        max-width: 400px;
    }

    .form-container h1 {
        font-size: 2em;
        font-weight: bold;
        color: #333333;
        margin-bottom: 20px;
        text-align: center;
    }

    .form-container input[type="text"],
    .form-container input[type="password"] {
        width: 100%;
        padding: 12px;
        margin-bottom: 15px;
        border: 1px solid #ccc;
        border-radius: 5px;
        font-size: 16px;
        box-sizing: border-box;
    }

    .password-container {
        position: relative;
        width: 100%;
    }

    .password-container .field-icon {
        position: absolute;
        top: 40%;
        right: 10px;
        transform: translateY(-50%);
        cursor: pointer;
    }

    .login-btn {
        font-size: 1em;
        background-color: #007bff;
        border-color: #007bff;
        color: #fff;
        border: none;
        padding: 12px 20px;
        border-radius: 5px;
        cursor: pointer;
        text-align: center;
        width: 100%;
        transition: background-color 0.3s, box-shadow 0.3s;
    }

    .login-btn:hover {
        background-color: #0056b3;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .register-link {
        font-size: 0.9em;
        color: #007bff;
        text-decoration: underline;
        cursor: pointer;
        margin-top: 15px;
        display: block;
        text-align: center;
    }

    .register-link:hover {
        color: #0056b3;
    }

    @media (max-width: 768px) {
        .split-screen {
            flex-direction: column;
            border-radius: 10px;
        }

        .split-screen .left {
            height: 200px;
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
            border-bottom-left-radius: 0;
            border-bottom-right-radius: 0;
        }

        .split-screen .right {
            padding: 50px;
        }
    }

    @media (max-width: 576px) {
        .split-screen .right {
            padding: 30px;
        }
    }
    </style>
</head>

<body>
    <div class="split-screen">
        <div class="left"></div>
        <div class="right">
            <div class="form-container">
                <h1>WeCare Clinic</h1>
                <form id="loginForm" action="login.php" method="POST">
                    <input type="text" name="username" placeholder="Username" required autocomplete="username">
                    <div class="password-container">
                        <input type="password" name="password" placeholder="Password" required
                            autocomplete="current-password">
                        <i class="fas fa-eye field-icon" id="togglePassword"></i>
                    </div>
                    <button type="submit" class="login-btn">Login</button>
                    <a href="register.php" class="register-link">Register</a>
                </form>
            </div>
        </div>
    </div>
    <script>
    document.getElementById("togglePassword").addEventListener("click", function() {
        var passwordField = document.querySelector('input[name="password"]');
        var type = passwordField.getAttribute("type") === "password" ? "text" : "password";
        passwordField.setAttribute("type", type);
        this.classList.toggle("fa-eye-slash");
    });
    </script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
