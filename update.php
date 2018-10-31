<?php
include 'conn.php';
require 'query.php';

//get id from the url and fetching data from the data base
if(isset($_GET['id'])){
    $id=$_GET['id'];
    $result=$conn->query($getperson);
    $data=$result->fetch_assoc();
}
//check whether the update button is pressed or not
if(isset($_POST['update'])){
    if ($conn->query($update) != TRUE) {
        echo "Error: " . $update . "<br>" . $conn->error;
        $notification="Something went wrong.Please try again..!";
    }
    else{
        echo "<script>alert('Record Updated Successfully')</script>";
        echo "<script>location.replace('students.php')</script>";
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
        <h4 class="text-light border"  style="background-color:orange;padding: 10px;border-top-right-radius: 10px;border-top-left-radius: 10px">Update Details</h4>
        <br>
        <form action="update.php?id=<?php echo $data['id'];?>" method="POST" style="padding:20px">
            <div class="row">
                <div class="col-md-3">
                    First Name:
                </div>
                <div class="col-md-9">
                    <input required class="form-control" type="text"  name="firstName" value=<?php echo $data['firstName'] ?>>
                </div>
            </div>
            <br>

            <div class="row">
                <div class="col-md-3">
                    Last Name:
                </div>
                <div class="col-md-9">
                    <input required class="form-control" type="text" name="lastName"  value=<?php echo $data['lastName'] ?>>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-3">
                    Screen Name:
                </div>
                <div class="col-md-9">
                    <input required class="form-control" type="text" name="screenName"  value=<?php echo $data['screenName'] ?> >
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-3">
                    Date of Birth:
                </div>
                <div class="col-md-9">
                    <input required class="form-control" type="text" name="dateofbirth"  value=<?php echo $data['dob'] ?> >
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
                                <input type="radio" name="gender" value="Male" <?php if($data['gender']=="Male"){echo "checked";} ?>  />
                                <span>Male</span>
                            </label>
                        </div>

                        <div class="col-md-4">
                            <label>
                                <input type="radio" name="gender" value="Female" <?php if($data['gender']=="Female"){echo "checked";} ?> />
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
                    <input class="form-control" type="text" name="country" value=<?php echo $data['country']?> >
                </div>
            </div>
            <br>

            <div class="row">
                <div class="col-md-3">
                    Email :
                </div>
                <div class="col-md-9">
                    <input required class="form-control" type="email" name="email" value=<?php echo $data['email']?> >
                </div>
            </div>
            <br>

            <div class="row">
                <div class="col-md-3">
                    Phone :
                </div>
                <div class="col-md-9">
                    <input required class="form-control" type="text" name="contact" value=<?php echo $data['contact']?> >
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
                    <button  type="submit" class="form-control btn btn-success" name="update" value=<?php echo $data['id']?> >Update</button>
                </div>
                <div class="col-md-2">
                    <button  type="reset" class="form-control btn btn-danger" name="cancel">Cancel</button>
                </div>
            </div>
        </form>
        <br>
        <h4 class="boder" style="height:40px;margin-bottom:5px;background-color: darkorange;-webkit-border-bottom-right-radius:10px;-webkit-border-bottom-left-radius:10px;"><br></h4>
    </div>


</div>

</body>
</html>
