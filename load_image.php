<?php
include 'connection.php';

$start = isset($_GET['start']) ? $_GET['start'] : 0; 
$limit = 3; 

$sql = "SELECT * FROM photos LIMIT $start, $limit";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo '<img src="data:image/jpeg;base64,' . base64_encode($row['photo_data']) . '" alt="' . $row['photo_type'] . '">';
    }
} else {
    echo "No more images found.";
}

$conn->close();
?>
