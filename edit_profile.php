<?php
session_start();

include 'connection.php';

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}

$user_name = $_SESSION['user'];

$select_sql = "SELECT name, email, password FROM owners WHERE name = ?";
$stmt = $conn->prepare($select_sql);
$stmt->bind_param("s", $user_name);
$stmt->execute();
$stmt->bind_result($user_name, $user_email, $password_hash);
$stmt->fetch();
$stmt->close();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $current_password = $_POST['current_password'];
    $new_password = $_POST['new_password'];
    $new_name = $_POST['name']; 

    if (password_verify($current_password, $password_hash)) {
        
        $new_password_hash = password_hash($new_password, PASSWORD_DEFAULT);
        $update_sql = "UPDATE owners SET password = ? WHERE name = ?";
        $stmt = $conn->prepare($update_sql);
        $stmt->bind_param("ss", $new_password_hash, $user_name);
        $stmt->execute();
        $stmt->close();

    
        $update_name_sql = "UPDATE owners SET name = ? WHERE name = ?";
        $stmt = $conn->prepare($update_name_sql);
        $stmt->bind_param("ss", $new_name, $user_name);
        $stmt->execute();
        $stmt->close();

        
        header("Location: login.php?password_updated=true");
        exit;
    } else {
        
        $error_message = "Current password is incorrect.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>   
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        h1 {
            text-align: center;
            margin-top: 20px;
        }
        form {
            width: 300px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        label {
            display: block;
            margin-bottom: 5px;
        }
        input[type="text"],
        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 8px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 3px;
            box-sizing: border-box;
        }
        input[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: #4caf50;
            color: #fff;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
        }
        .error-message {
            color: red;
            margin-bottom: 15px;
        }
    </style>
</head>
<body>
    <h1>Edit Profile</h1>
    <?php if (isset($error_message)) echo "<p class='error-message'>$error_message</p>"; ?>
    <form method="post" action="">
        
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" value="<?php echo $user_name; ?>"><br><br>
        
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="<?php echo $user_email; ?>"><br><br>
        
        <label for="current_password">Current Password:</label>
        <input type="password" id="current_password" name="current_password" required><br><br>

        <label for="new_password">New Password:</label>
        <input type="password" id="new_password" name="new_password" required><br><br>
        
        <input type="submit" value="Save Changes">
    </form>
</body>
</html>
