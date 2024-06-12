<?php
session_start();

include 'connection.php';

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}

if(isset($_GET['logout'])) {
    session_destroy();
    header("Location: login.php");   
    exit;
}

// 1 isliyai liyai taki pta chle 1 wala admin hai
    
$canDeleteBookings = $_SESSION['role_id'] == 1; 

$recordsPerPage = 5; 
$page = isset($_GET['page']) && is_numeric($_GET['page']) ? $_GET['page'] : 1;
$offset = ($page - 1) * $recordsPerPage;

$result = null;


if(isset($_POST['delete']) && $canDeleteBookings) { 
    if(!empty($_POST['checkbox'])) {
        foreach($_POST['checkbox'] as $booking_id) {
            $delete_sql = "UPDATE bookings SET is_deleted = TRUE WHERE booking_id = ?";
            $stmt = $conn->prepare($delete_sql);
            $stmt->bind_param("i", $booking_id);
            $stmt->execute();
        }
    } else {   
        $alert_message = "Please select at least one row to delete.";
    }
}

$search_term = isset($_POST['search']) ? $_POST['search'] : '';
$start_date = isset($_GET['start_date']) ? $_GET['start_date'] : '';
$end_date = isset($_GET['end_date']) ? $_GET['end_date'] : '';
$selected_rooms = isset($_POST['selected_rooms']) ? $_POST['selected_rooms'] : [];

$sql = "SELECT * FROM bookings WHERE is_deleted = FALSE"; 

if (!empty($search_term)) {
    $sql .= " AND guest_name LIKE '%$search_term%'";
} elseif (!empty($start_date) && !empty($end_date)) {
    $sql .= " AND check_in_date BETWEEN '$start_date' AND '$end_date'";
} elseif (!empty($selected_rooms)) {                 
    $selected_rooms_str = implode(',', $selected_rooms);
    $sql .= " AND room_id IN ($selected_rooms_str)";
}


$totalRecordsSql = "SELECT COUNT(*) AS total FROM ($sql) AS subQuery";
$totalRecordsResult = $conn->query($totalRecordsSql);
$totalRecords = $totalRecordsResult->fetch_assoc()['total'];

$totalPages = ceil($totalRecords / $recordsPerPage);

$sql .= " LIMIT $recordsPerPage OFFSET $offset";

$result = $conn->query($sql);

$total_appointments_sql = "SELECT COUNT(*) AS total_appointments FROM bookings WHERE is_deleted = FALSE";
$total_appointments_result = $conn->query($total_appointments_sql);
$total_appointments = $total_appointments_result->fetch_assoc()['total_appointments'];
?>

<!DOCTYPE html>   
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Dashboard</title>
    <style>
        body {   
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            padding: 8px; 
            border: 1px solid #ddd;
            text-align: left;
            font-size: 14px; 
        }
        th {
            background-color: #f2f2f2;
            color: #333;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        tr:hover {
            background-color: #f2f2f2;
        }
        form {
            margin-bottom: 20px;
        }
        label {
            font-weight: bold;
        }
        input[type="text"], input[type="date"] {
            padding: 5px;
            border-radius: 4px;
            border: 1px solid #ccc;
            margin-right: 10px;
        }
        input[type="submit"] {
            padding: 5px 15px;
            background-color: #333;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        button {
            padding: 5px 15px;
            background-color: #333;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            margin-top: 20px;
            margin-right: 10px;
        }
        button:hover {
            background-color: #555;
        }
        #header {
            background-color: #333;
            color: #fff;
            padding: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        #header a {
            color: #fff;
            text-decoration: none;
            margin-left: 20px;
        }
        #sidebar {
            width: 250px;
            background-color: #f2f2f2;
            padding: 20px;
            float: left;
            height: 100vh;
        }
        #content {
            margin-left: 270px;
            padding: 20px;
        }
        h2 {
            margin-bottom: 20px;
        }
        input[type="checkbox"] {
            margin-right: 5px;
        }
        .error-message {
            color: red;
            margin-bottom: 10px;
        }
        .total-appointments {
            margin-bottom: 20px;
        }
        .pagination {
            margin-top: 20px;
        }
        .pagination a {
            padding: 8px;
            text-decoration: none;
            color: #333;
            background-color: #f2f2f2;
            border: 1px solid #ddd;
            margin-right: 5px;
        }
        .pagination a:hover {
            background-color: #ddd;
        }
        .pagination .active {
            background-color: #333;
            color: #fff;
        }
        .jack{
            height: 76px;
    width: 80px;
    border-radius:50%;
        }
    </style>
</head>
<body>
    
    <div id="header">
    <img class="jack" src="pics/<?php echo $_SESSION['owner_photo_path']; ?>" alt="Owner Photo">

    <h1>Booking Dashboard</h1>
    <div id="profile">
        <?php if(isset($_SESSION['owner_photo_path'])): ?>
        <?php endif; ?>
        <span>Welcome, <?php echo $_SESSION['user']; ?></span>
        <a href="edit_profile.php">Profile</a>
        <a href="?logout">Logout</a>
    </div>
</div>
    <div id="sidebar">
        
        <form method="post" action="">   
            <label for="search">Search by Guest Name:</label>
            <input type="text" id="search" name="search">
            <input type="submit" value="Search">
        </form>
        
        <form method="get" action="">
            <label for="start_date">Start Date:</label>
            <input type="date" id="start_date" name="start_date">
            <label for="end_date">End Date:</label>
            <input type="date" id="end_date" name="end_date">
            <input type="submit" value="Filter">
        </form>

        <form method="post" action="">
            <label>Select Rooms:</label><br>
            <?php  
                $rooms_query = "SELECT * FROM rooms";
                $rooms_result = $conn->query($rooms_query);
                if ($rooms_result->num_rows > 0) {
                    while ($row = $rooms_result->fetch_assoc()) {
                        echo "<input type='checkbox' name='selected_rooms[]' value='" . $row['room_id'] . "'>";
                        echo "<label for='room_" . $row['room_id'] . "'>" . $row['room_number'] . "</label><br>";
                    }
                }
            ?>
            <input type="submit" value="Filter Rooms">
        </form>

        <a href="add_services.php" style="text-decoration: none;">
        <button>Add Services</button>
    </a>
    
        <a href="signup.php" style="text-decoration: none;">
            <button>New Admin Created</button>
        </a>

        <a href="home.php" style="text-decoration: none;">
            <button>home</button>
        </a>

        <button onclick="location.href='add_photo.php'">Add Photo</button>


        
    </div>
    <div id="content">       
        <h2>Booking List</h2>

        <?php
            if(isset($alert_message)) {
                echo "<div class='error-message'>$alert_message</div>";
            }
        ?>
        
        <p class="total-appointments">Total Appointments: <?php echo $total_appointments; ?></p>
    
        <form method="post" action="">
            <table>
                <tr>
                    <th></th>
                    <th>Booking ID</th>
                    <th>Guest Name</th>
                    <th>Guest Email</th>
                    <th>Room ID</th>
                    <th>Check-in Date</th>
                    <th>Check-out Date</th>
                    
                </tr>
                <?php
                if ($result && $result->num_rows > 0) {  
                    while ($row = $result->fetch_assoc()) {   
                        echo "<tr>";
                        echo "<td><input type='checkbox' name='checkbox[]' class='selected' value='" . $row["booking_id"] . "'";
                        // Only add disabled attribute if user cannot delete bookings
                        echo (!$canDeleteBookings) ? " disabled" : "";
                        echo "></td>";
                        echo "<td>" . $row["booking_id"] . "</td>";
                        echo "<td>" . $row["guest_name"] . "</td>";
                        echo "<td>" . $row["guest_email"] . "</td>";
                        echo "<td>" . $row["room_id"] . "</td>";
                        echo "<td>" . $row["check_in_date"] . "</td>";
                        echo "<td>" . $row["check_out_date"] . "</td>";
                        echo "</tr>";
                    }
                } else {     
                    echo "<tr><td colspan='7'>No bookings found.</td></tr>";
                } 
                ?>
            </table>

            
            <div class="pagination">
                <?php if ($page > 1): ?>
                    <a href="?page=<?php echo $page - 1; ?>">Previous</a>
                <?php endif; ?>
                <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                    <a href="?page=<?php echo $i; ?>" <?php if ($i == $page) echo 'class="active"'; ?>><?php echo $i; ?></a>
                <?php endfor; ?>
                <?php if ($page < $totalPages): ?>
                    <a href="?page=<?php echo $page + 1; ?>">Next</a>
                <?php endif; ?>
            </div>

            <?php if ($canDeleteBookings): ?>
                <button type="button" id="selectAll">Select All</button>
                <button type="button" id="clearAll">Clear All</button>
                <input type="submit" name="delete" value="Delete Selected Bookings">
            <?php endif; ?>
        </form>
        <form method="post" action="index.php">
            <button type="submit">Export to Excel</button>
        </form>
    </div> 
    
    <script>  
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('selectAll').addEventListener('click', function() {
                var checkboxes = document.querySelectorAll('.selected');
                checkboxes.forEach(function(checkbox) {
                    checkbox.checked = true;
                });
            }); 
            
            document.getElementById('clearAll').addEventListener('click', function() {
                var checkboxes = document.querySelectorAll('.selected');
                checkboxes.forEach(function(checkbox) {
                    checkbox.checked = false;
                });
            });
        });


        
    </script>

 


</body>
</html>
