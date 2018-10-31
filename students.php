<?php 
require 'conn.php';
require 'query.php';
//fetch data from the database
$result=$conn->query($getdata);

//Check whether the
if(isset($_GET['delete'])){
    if ($conn->query($delete) === TRUE) {
        echo "<script>alert('Record Deleted Successfully')</script>";
        echo "<script>location.replace('students.php')</script>";
    } else {
        echo "Error deleting record: " . $conn->error;
    }

}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <style>
        table {
            border-collapse: collapse;
        }

        td, th {
            border: 1px solid darkgray;
            padding-left: 5px;
            padding-top: 5px;
            padding-right: 5px;
            padding-bottom: 5px;
        }
        td{
            width: 150px;
        }

    </style>

</head>

<body>
<br><br><br>
<div class="container-fluid col-md-8 col-md-offset-2">

	<div class=" bg-dark text-light text-center "  style="border-radius: 10px">
        <h4 class="text-left text-light"  style="background-color:#e59500;padding: 10px;border-radius: 10px">STUDENTS</h4>
        <br>
        <div class="col-md-8 col-md offset-2">
            <table>
                <tr>
                    <th>Id</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th></th>
                </tr>
                <?php
//displaying fetched data in to the table
                if ($result->num_rows > 0) {
                    while($data = $result->fetch_assoc()) {
                        $row="";
                        $row=$row."<tr>
    							<td>$data[id]</td>
								<td>$data[firstName]</td>
								<td>$data[lastName]</td>
								<td style='width: 250px'>
									<a href='update.php?id=$data[id]'> <button  class='btn btn-primary'>Edit</button></a>
									<a href='students.php?delete=$data[id]'> <button  class='btn btn-danger'>Delete</button></a>
								</td>
							</tr>"."<br>";
                        echo $row;
                    }
                } else {
                    echo "0 results";
                }
                ?>
            </table>
        </div>

		<br>
	</div>
	<h4 "container-fluid bg-dark"><br></h4>

</div>

</body>
</html>
