<?php
include 'connection.php';
$message = ""; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    if (isset($_FILES['pics_file'])) {
        $file_name=$_FILES['pics_file']['name'];
        $file_folder=$_FILES['pics_file']['tmp_name'];
        if (move_uploaded_file($file_folder, "pics/".$file_name)) {
           echo "inserted into pics";
        }else{
            echo "fp";
        }
    };
    
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    

    $stmt = $conn->prepare("INSERT INTO owners (name, email, password, owner_photo_path) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $name, $email, $hashed_password ,$file_name);

    if ($stmt->execute()) {
        $message = "Signup successful!";
        header("Location: login.php");
        exit();
    } else {
        header("Location: signup.php?error=1");
        exit();
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup</title>
</head>
<body>
    <header>
        <h1>Signup</h1>
    </header>
    <main>
        <div class="container">
            <h2>Register as Owner</h2>
            <?php if(!empty($message)): ?>
                <p><?php echo $message; ?></p> 
            <?php endif; ?>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
                <label for="name">Name:</label><br>
                <input type="text" id="name" name="name" required><br><br>

                <label for="email">Email:</label><br>
                <input type="email" id="email" name="email" required><br><br>

                <label for="password">Password:</label><br>
                <input type="password" id="password" name="password" required><br><br>

                <label for="password">file:</label><br>
                <input type="file" id="password" name="pics_file" required><br><br>

                <input type="submit" value="Sign Up">
            </form>
        </div>
    </main>
    <footer>
        
    </footer>
</body>
</html>
