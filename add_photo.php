<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Photo</title>
</head>
<body>
    <h2>Add Photo</h2>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
        <input type="file" name="photo" accept="image/*">
        <input type="submit" value="Upload">
    </form>

    <?php
 include "connection.php";
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $photo = $_FILES["photo"];

        if ($photo["error"] === UPLOAD_ERR_OK) {
            $photoData = file_get_contents($photo["tmp_name"]);
            $photoData = $conn->real_escape_string($photoData);
            $photoType = $photo["type"];

        
            $sql = "INSERT INTO photos (photo_data, photo_type) VALUES ('$photoData', '$photoType')";

            if ($conn->query($sql) === TRUE) {
                echo "Photo uploaded successfully.";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        } else {
            echo "Error uploading photo: " . $photo["error"];
        }
    }
    ?>
</body>
</html>
