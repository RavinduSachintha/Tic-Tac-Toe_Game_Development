<?php
//include database connection file
include 'conn.php';
$notification="";
//check whether the submit buttun is pressed or not
if(isset($_POST['submit'])) {
    include 'query.php';
    if (isset($_POST['terms'])){
        if($_POST['password']==$_POST['confirmpassword']){
            if ($conn->query($indata) != TRUE) {
                echo "Error: " . $indata . "<br>" . $conn->error;
                $notification="Something went wrong.Please try again..!";
            }
            else{
                $notification="Record has been submited Sucessfully";
            }
        }
        else{
            $notification="Password mismatched";
        }

        $conn->close();
    }else{
        $notification="Please Select the Terms and Conditions checkbox";
    }

}
?>

<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
</head>

<body>
<br><br><br>
<div class="container-fluid col-md-8 col-md-offset-2">

	<div class=" bg-dark text-light" style="border-radius: 10px">
        <h4 class="text-light border"  style="background-color:orange;padding: 10px;border-top-right-radius: 10px;border-top-left-radius: 10px">SIGN UP</h4>
        <br>
        <form action="form.php" method="post" style="padding:20px">
			<div class="row">
				<div class="col-md-3">
					First Name:
				</div>
				<div class="col-md-9">
					<input required class="form-control" type="text"  name="firstName" placeholder="First Name">
				</div>
			</div>
			<br>
			
			<div class="row">
				<div class="col-md-3">
					Last Name:
				</div>
				<div class="col-md-9">
					<input required class="form-control" type="text" name="lastName"  placeholder="Last Name">
				</div>
			</div>
			<br>
			<div class="row">
				<div class="col-md-3">
					Screen Name:
				</div>
				<div class="col-md-9">
					<input required class="form-control" type="text" name="screenName"  placeholder="Screen Name" >
				</div>
			</div>
			<br>
			<div class="row">
				<div class="col-md-3">
					Date of Birth:
				</div>
				<div class="col-md-4">
					<select class="form-control" name="month"  placeholder="month">
					  <option value="01">January</option>
					  <option value="02">February</option>
					  <option value="03">March</option>
					  <option value="04">April</option>
					  <option value="05">May</option>
					  <option value="06">June</option>
					  <option value="07">July</option>
					  <option value="08">August</option>
					  <option value="09">September</option>
					  <option value="10">October</option>
					  <option value="11">November</option>
					  <option value="12">December</option>
					</select>
				</div>
				<div class="col-md-2">
                    <select class="form-control" name="date" placeholder="date">
                        <?php
                        for($i=01;$i<32;$i++){
                            echo "<option value=$i>$i</option>";
                        }
                        ?>
                    </select>
				</div>
				<div class="col-md-3">
                    <select class="form-control" name="year" placeholder="year">
                        <?php
                        for($i=1990;$i<2018;$i++){
                            echo "<option value=$i>$i</option>";
                        }
                        ?>
                    </select>
				</div>
			</div>
			
			<br>
			
			<div class="row">
				<div class="col-md-3">
					Gender:
				</div>
				<div class="col-md-9">
					<div class="row">
						<div class="col-md-4">
							<label>
									<input type="radio" name="gender" value="Male" checked  />
								<span>Male</span>
							</label>
						</div>
						
						<div class="col-md-4">
							<label>
									<input type="radio" name="gender" value="Female"  />
								<span>Female</span>
							</label>
						</div>
						
					</div>
				</div>
			</div>
			<br>
			
			<div class="row">
				<div class="col-md-3">
					Country :
				</div>
				<div class="col-md-9">
					<input class="form-control" type="text" name="country" placeholder="Country" >
				</div>
			</div>
			<br>
			
			<div class="row">
				<div class="col-md-3">
					Email :
				</div>
				<div class="col-md-9">
					<input required class="form-control" type="email" name="email" placeholder="Email" >
				</div>
			</div>
			<br>
			
			<div class="row">
				<div class="col-md-3">
					Phone :
				</div>
				<div class="col-md-9">
					<input required class="form-control" type="text" name="contact" placeholder="Phone No" >
				</div>
			</div>
			<br>
			
			<div class="row">
				<div class="col-md-3">
					Password :
				</div>
				<div class="col-md-9">
					<input required class="form-control" type="password" name="password" placeholder="Password" >
				</div>
			</div>
			<br>
			
			<div class="row">
				<div class="col-md-3">
					Confirm Password :
				</div>
				<div class="col-md-9">
					<input required class="form-control" type="password" name="confirmpassword" placeholder="Confirm Password" >
				</div>
			</div>
			<br>

            <div class="row ">
                <div class="col-md-3"></div>
                <div class="col-md-7">
                    <input  type="checkbox" name="terms" value="checked"> I agree to the Terms and Conditions
                </div>
            </div>
            <br>

			<div class=' row'>
				<div class="col-md-8  " style="color: lawngreen">
                    <?php
                        if(isset($_POST['submit'])){
                            echo $notification;
                        }
                    ?>
				</div>
				<div class=" col-md-2 ">
					<button  type="submit" class="form-control btn btn-success" value="submit" name="submit">Submit</button>
				</div>
				<div class="col-md-2">
					<button  type="reset" class="form-control btn btn-danger" value="cancel">Cancel</button>
				</div>
			</div>
		</form>
		<br>
        <h4 class="boder" style="height:40px;margin-bottom:5px;background-color: darkorange;-webkit-border-bottom-right-radius:10px;-webkit-border-bottom-left-radius:10px;"><br></h4>
	</div>


</div>

</body>
</html>
