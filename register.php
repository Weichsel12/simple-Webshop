<?php 
// register.php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Validierung: Passwort mindestens 6 Zeichen lang
    if (strlen($password) < 6) {
        echo "<p style='color:red;'>Password must be at least 6 characters long.</p>";
    } else {
        // Passwort hashen
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);

        // Prüfen, ob der Benutzername bereits existiert
        $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            echo "<p style='color:red;'>Username is already taken. Please choose a different one.</p>";
        } else {
            // Benutzer registrieren, Rolle wird auf 'customer' gesetzt
            $role = 'customer';
            $stmt = $conn->prepare("INSERT INTO users (username, password, role) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $username, $hashed_password, $role);

            if ($stmt->execute()) {
                echo "<p style='color:green;'>Registration successful! <a href='login.php'>Login here</a>.</p>";
            } else {
                echo "<p style='color:red;'>An error occurred. Please try again later.</p>";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        h1 {
            color: #333;
            margin-bottom: 20px;
            text-align: center;
        }

        .form-container {
            background-color: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 300px;
            text-align: center;
        }

        .form-container input {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        .form-container button {
            width: 100%;
            padding: 10px;
            background-color: #2a9d8f;
            border: none;
            color: white;
            border-radius: 4px;
            cursor: pointer;
        }

        .form-container button:hover {
            background-color: #1f7a71;
        }

        .form-container a {
            display: block;
            margin-top: 10px;
            color: #2a9d8f;
            text-decoration: none;
        }

        .form-container a:hover {
            text-decoration: underline;
        }

        p {
            color: red;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h1>Register</h1>
        <form method="POST">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password (min. 6 characters)" required>
            <button type="submit">Register</button>
        </form>
        <p>Already have an account? <a href="login.php">Login here</a>.</p>
    </div>
</body>
</html>