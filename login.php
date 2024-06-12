<?php
session_start();

include 'connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];   
    $password = $_POST['password'];
    

    $stmt = $conn->prepare("SELECT password, role_id,name FROM owners WHERE name = ?");
    $stmt->bind_param("s", $name);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $hashed_password = $row['password'];
        $role_id = $row['role_id'];
        

      // After verifying the password in the login.php script
if (password_verify($password, $hashed_password)) {
    $_SESSION['user'] = $name;
    $_SESSION['role_id'] = $role_id;
    
    // Fetch owner's photo path from the database
    $photo_stmt = $conn->prepare("SELECT owner_photo_path FROM owners WHERE name = ?");
    $photo_stmt->bind_param("s", $name);
    $photo_stmt->execute();
    $photo_result = $photo_stmt->get_result();
    $photo_row = $photo_result->fetch_assoc();
    
    // Store owner's photo path in session
    $_SESSION['owner_photo_path'] = $photo_row['owner_photo_path'];
    echo  $_SESSION['owner_photo_path'];
    header("Location: dashborad.php");
    exit;
}
    }
}
?>   

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .login-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 300px;
            width: 100%;
        }

        h2 {
            margin-top: 0;
            text-align: center;
        }

        label {
            font-weight: bold;
        }

        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 8px;
            margin: 5px 0 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #4caf50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        p.error {
            color: #ff0000;
            margin-top: 10px;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h2>Login</h2>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <label for="name">Username:</label><br>                                    
            <input type="text" id="name" name="name"><br>
            <label for="password">Password:</label><br>
            <input type="password" id="password" name="password"><br>
            <input type="submit" value="Login">
        </form>
        <?php if(isset($error)) { echo "<p class='error'>$error</p>"; } ?>
    </div>
</body>
</html>
