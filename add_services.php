<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include "connection.php";
    $room_type_custom = $_POST["room_type_custom"]; 
    $room_number = $_POST["room_number"];
    $price = $_POST["price"];
    $availability = isset($_POST["availability"]) ? 1 : 0;
    $ac_room_description = $_POST["ac_room_description"];
    $non_ac_room_description = $_POST["non_ac_room_description"];

    
    $sql = "INSERT INTO rooms (room_type, room_number, price, availability, ac_room_description, non_ac_room_description) 
            VALUES ('$room_type_custom', '$room_number', $price, $availability, '$ac_room_description', '$non_ac_room_description')";

    if (mysqli_query($conn, $sql)) {
        echo "Record inserted successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

    mysqli_close($conn);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Room</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f2f2f2;
        }

        .container {
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        form {
            margin-bottom: 20px;
        }

        input[type="text"],
        input[type="checkbox"],
        input[type="submit"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        input[type="checkbox"] {
            width: auto;
        }

        input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Add Room</h2>
        <form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
            Room Type: <input type="text" name="room_type_custom"><br><br>
            Room Number: <input type="text" name="room_number"><br><br>
            Price: <input type="text" name="price"><br><br>
            Availability: <input type="checkbox" name="availability" value="1"><br><br>
            AC Room Description: <input type="text" name="ac_room_description"><br><br>
            Non-AC Room Description: <input type="text" name="non_ac_room_description"><br><br>
            <input type="submit" value="Submit">
        </form>
    </div>
</body>
</html>
