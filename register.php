<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (
        isset($_POST['name']) && isset($_POST['password']) && isset($_POST['email']) &&
        isset($_POST['password1']) && isset($_POST['phone']) && isset($_POST['address'])
    ) {
        // Include the database connection file
        require_once 'dbconnect.php';

        $username = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $password1 = $_POST['password1'];
        $phoneno = $_POST['phone'];
        $address = $_POST['address'];

        // Check if passwords match and are at least 8 characters long
        if ($password !== $password1) {
            echo "<script>alert('Passwords do not match.');</script>";
            echo "<script>window.location.href = 'register.php';</script>";
            exit;
        } elseif (strlen($password) < 8) {
            echo "<script>alert('Password must be at least 8 characters long.');</script>";
            echo "<script>window.location.href = 'register.php';</script>";
            exit;
        }

        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        try {
            $stmt = $conn->prepare("INSERT INTO users (name, email, password, phoneno, address) VALUES (:username, :email, :password, :phoneno, :address)");
            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':password', $hashed_password);
            $stmt->bindParam(':phoneno', $phoneno);
            $stmt->bindParam(':address', $address);

            if ($stmt->execute()) {
                echo "<script>alert('Registration successful');</script>";
                echo "<script>window.location.href = 'login.php';</script>";
            } else {
                echo "<script>alert('Error: Could not execute the statement');</script>";
            }
        } catch (PDOException $e) {
            echo "<script>alert('Error: " . $e->getMessage() . "');</script>";
        }

        $conn = null;
    } else {
        echo "<script>alert('Please fill in all required fields.');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - WeCare Clinic</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
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

    .form-container {
        width: 90%;
        max-width: 600px;
        padding: 20px;
        margin-bottom: 40px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        border-radius: 10px;
        background-color: rgba(255, 255, 255, 0.9);
    }

    .form-container h1 {
        font-size: 2em;
        font-weight: bold;
        color: #333333;
        margin-bottom: 20px;
        text-align: center;
    }

    .form-container input[type="text"],
    .form-container input[type="password"],
    .form-container input[type="email"],
    .form-container input[type="tel"],
    .form-container textarea {
        width: 100%;
        padding: 6px;
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
        transform: translateY(-70%);
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
        margin-top: 10px;
        display: block;
        text-align: center;
    }

    .register-link:hover {
        color: #0056b3;
    }

    .footer {
        position: fixed;
        bottom: 0;
        width: 100%;
        background-color: rgba(255, 255, 255, 0.9);
        padding: 10px 0;
        text-align: center;
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
    <div class="form-container">
        <h1>Register New Patient</h1>
        <form id="registerForm" action="register.php" method="POST">
            <input type="text" name="name" placeholder="Name" required>
            <input type="email" name="email" placeholder="Email" required>
            <div class="password-container">
                <input type="password" id="password" name="password" placeholder="Password" required
                    autocomplete="current-password" minlength="8">
                <i class="fas fa-eye field-icon" id="togglePassword"></i>
            </div>
            <div class="password-container">
                <input type="password" id="password1" name="password1" placeholder="Re-type password" required
                    autocomplete="current-password" minlength="8" autocomplete="current-password">
                <i class="fas fa-eye field-icon" id="togglePassword1"></i>
            </div>
            <input type="tel" name="phone" placeholder="Phone Number" required>
            <textarea name="address" rows="3" placeholder="Address" required></textarea>
            <button type="submit" class="login-btn">Register</button>
        </form>
    </div>

    <footer class="footer">
        <div class="container">
            <span class="text-muted">© 2024 WeCare Clinic. All rights reserved.</span>
        </div>
    </footer>

    <script>
    document.getElementById("togglePassword").addEventListener("click", function() {
        var passwordField = document.getElementById("password");
        var type = passwordField.getAttribute("type") === "password" ? "text" : "password";
        passwordField.setAttribute("type", type);
        this.classList.toggle("fa-eye-slash");
    });

    document.getElementById("togglePassword1").addEventListener("click", function() {
        var passwordField1 = document.getElementById("password1");
        var type1 = passwordField1.getAttribute("type") === "password" ? "text" : "password";
        passwordField1.setAttribute("type", type1);
        this.classList.toggle("fa-eye-slash");
    });

    document.getElementById("registerForm").addEventListener("submit", function(event) {
        event.preventDefault();
        var formData = new FormData(this);
        fetch("register.php", {
                method: "POST",
                body: formData
            }).then(response => {
                if (response.ok) {
                    document.getElementById("registerForm").reset();
                    alert("Registration successful!");
                } else {
                    throw new Error("Error occurred while registering.");
                }
            })
            .catch(error => {
                console.error("Registration Error:", error);
            });
    });
    </script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
