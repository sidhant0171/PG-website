<?php
include 'connection.php';
$message = "";


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $guest_name = $_POST['guest_name'];  
    $guest_email = $_POST['guest_email'];   
    $check_in_date = $_POST['check_in_date'];
    $check_out_date = $_POST['check_out_date'];
    $room_id = $_POST['room_type']; 

    $sql = "INSERT INTO bookings (guest_name, guest_email, room_id, check_in_date, check_out_date)
            VALUES ('$guest_name', '$guest_email', '$room_id', '$check_in_date', '$check_out_date')";

    if ($conn->query($sql) === TRUE) {
        $message = "Welcome, $guest_name! Your booking was successful!";
    } else {
        $message = "Error: " . $sql . "<br>" . $conn->error; 
    }
}
?>                           
<!DOCTYPE html>
<html lang="en">
<head>   
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Services</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11">
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
            text-align: left;
        }
        
        nav ul {
            margin: 0;
            padding: 0;
            list-style-type: none;
        }
        
        nav ul li {
            display: inline;
            margin-right: 10px;
        }
        
        nav ul li a {
            color: #fff;
            text-decoration: none;
        }
        
        main {
            padding: 20px;
        }
        
        .container {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        
        form {
            max-width: 400px;
            margin: 0 auto;
        }
        
        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        
        input[type="text"],
        input[type="email"],
        input[type="date"],
        select {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        
        input[type="submit"] {
            background-color: #333;
            color: #fff;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            border-radius: 5px;
        }
        
        input[type="submit"]:hover {
            background-color: #555;
        }
    </style>
</head>
<body>
    <header>
        <h1>services</h1>
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
            <h2>Services Offered</h2>
            <?php if(!empty($message)): ?>
                <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                <script>
                    Swal.fire({
                        title: 'Booking Successful!',
                        text: "<?php echo $message; ?>",
                        icon: 'success',
                        confirmButtonText: 'OK'
                    });
                </script>
            <?php endif; ?>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <label for="guest_name">Your Name:</label><br>
                <input type="text" id="guest_name" name="guest_name" maxlength="10" required><br><br>


    



                
                <label for="guest_email">Your Email:</label><br>
                <input type="email" id="guest_email" name="guest_email" required><br><br>
                
                <label for="check_in_date">Check-in Date:</label><br>
                <input type="date" id="check_in_date" name="check_in_date" required><br>
                
                <label for="check_out_date">Check-out Date:</label><br>
                <input type="date" id="check_out_date" name="check_out_date" required><br>
                
                <label for="room_type">Room Type:</label><br>
                <select id="room_type" name="room_type" required>
                    <option value="1">AC Room</option>
                    <option value="2">Non-AC Room</option>
                </select><br>
                
                <input type="submit" value="Book Now">
            </form>
        </div>
    </main>
    <footer>
        
    </footer>
</body>
</html>
