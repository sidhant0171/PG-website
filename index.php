<?php 

include('connection.php');

$sql="select * from bookings";
$result=mysqli_query($conn,$sql);

$finaldata=array();

while($data=mysqli_fetch_assoc($result))
{
	$finaldata[]=$data;
}

if(isset($_POST['export'])) 
{
	$filename = "data".date('Ymdhis') . ".xls";			
	header("Content-Type: application/vnd.ms-excel");
	header("Content-Disposition: attachment; filename=\"$filename\"");
	
	$firstrow=false;
  // foreach ($variable as $key => $value) {
  //   # code...
  // }
	foreach($finaldata as $data)
	{
		if(!$firstrow)
		{
			echo implode("\t",array_keys($data))."\n";
			$firstrow=true;
		}
		
		echo implode("\t",array_values($data))."\n";
		
	}
	
	exit;
	
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Export Data to excel</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>

<div class="container mt-3">
  <h2>Export Data to excel</h2>
       
<form method="post">
<input type="submit" class="btn btn-success" name="export" value="Export to Excel">
</form>
	   
  <table class="table table-striped">
    <thead>
      <tr>
        <th>booking_id</th>
        <th>guest_name</th>
        <th>guest_email</th>
		<th>room_id</th>
        <th>check_in_date</th>
        <th>check_out_date</th>
      </tr>
    </thead>
    <tbody>
	<?php 
	
	foreach($finaldata as $data)
	{?>
      <tr>
        <td><?php echo $data['booking_id'];?></td>
        <td><?php echo $data['guest_name'];?></td>
        <td><?php echo $data['guest_email'];?></td>
		  <td><?php echo $data['room_id'];?></td>
          <td><?php echo $data['check_in_date'];?></td>
          <td><?php echo $data['check_out_date'];?></td>
      </tr>
	<?php } ?>  
    </tbody> 
  </table>
</div>

</body>
</html>
