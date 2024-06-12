<?php
include 'connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];
    

    $photo_name = $_FILES['photo']['name'];
    $photo_tmp_name = $_FILES['photo']['tmp_name'];
    $photo_error = $_FILES['photo']['error'];

    if ($photo_error === 0) {
        
        $photo_destination = 'uploads/' . $photo_name;
        move_uploaded_file($photo_tmp_name, $photo_destination);
        
        
        $photo_data = file_get_contents($photo_destination);
        
        
        $stmt = $conn->prepare("INSERT INTO contacts (name, email, message, photo, photo_data) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $name, $email, $message, $photo_name, $photo_data);

        if ($stmt->execute()) {
            echo "Message sent successfully!";
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Error uploading photo: " . $photo_error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f0f0f0;
            background-image: url("pics/futuristic-background-design_23-2148503793.avif");
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }

        header {
            background-color: #333;
            color: #fff;
            padding: 20px;
        }

        nav ul {
            list-style-type: none;
            padding: 0;
        }

        nav ul li {
            display: inline;
            margin-right: 20px;
        }

        nav ul li a {
            color: #fff;
            text-decoration: none;
        }

        main {
            padding: 20px;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            color: #333;
        }

        label {
            display: block;
            margin-bottom: 10px;
        }

        input[type="text"],
        input[type="email"],
        textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 4px;
            resize: vertical;
        }

        input[type="file"] {
            margin-bottom: 20px;
        }

        input[type="submit"] {
            background-color: #333;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #555;
        }
    </style>
</head>
<body>
    <header>
        <h1>Contact Us</h1> 
        <nav>
            <ul>
                <li><a href="home.php">Home</a></li>
                <li><a href="about.php">About</a></li>
                <li><a href="services.php">Services</a></li>
                <li><a href="contact.php">Contact Us</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <div class="container">
            <h2>Get in Touch</h2>
            <p>Feel free to reach out to us via the contact form below or visit us at our office:</p>
            <p><strong>Address</strong><br>
            100 xportsoft<br>
            Ambala Cantt<br>
            Haryana</p>
            <form action="contact.php" method="POST" enctype="multipart/form-data">
                <label for="name">Name</label>
                <input type="text" id="name" name="name" maxlength="10" required>

                <label for="email">Email</label>
                <input type="email" id="email" name="email" required>

                <label for="message">Message</label>
                <textarea id="message" name="message" rows="5" maxlength="100" required></textarea>

                <label for="photo">Upload Photo</label>
                <input type="file" id="photo" name="photo" accept="image/*">

                <input type="submit" value="Send Message">
            </form>
        </div>
    </main>
</body>
</html>
