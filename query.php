<?php
if(isset($_POST['submit'])) {
    $firstName = $_POST["firstName"];
    $lastName = $_POST["lastName"];
    $screenName = $_POST["screenName"];
    $dob = $_POST['year'] . "-" . $_POST['month'] . "-" . $_POST['date'];
    $gender = $_POST['gender'];
    $country = $_POST['country'];
    $email = $_POST['email'];
    $contact = $_POST['contact'];
    $password = md5($_POST['password']);

    $indata = "INSERT INTO `user` (`firstName`, `lastName`, `screenName`, `dob`, `gender`, `country`, `email`, `contact`, `password`) VALUES ('$firstName', '$lastName', '$screenName', '$dob', '$gender', '$country', '$email', '$contact', '$password')";
}

if(isset($_GET['delete'])){
    $id=$_GET['delete'];
    $delete= "DELETE FROM `user` WHERE `id` = $id";
}

if(isset($_POST['update'])) {
    $id=$_GET['id'];
    $firstName = $_POST["firstName"];
    $lastName = $_POST["lastName"];
    $screenName = $_POST["screenName"];
    $dob = $_POST['dateofbirth'];
    $gender = $_POST['gender'];
    $country = $_POST['country'];
    $email = $_POST['email'];
    $contact = $_POST['contact'];
    $update="UPDATE `user` SET `firstName` = '$firstName', `lastName` = '$lastName', `screenName` = '$screenName', `dob` = '$dob', `gender` = '$gender', `country` = '$country', `email` = '$email', `contact` = '$contact'  WHERE `user`.`id` = $id";
//    $update="UPDATE `user` SET `firstName` = 'sachinth', `lastName` = 'jwfj', `screenName` = 'nwanf', `dob` = 'ewfo', `gender` = 'male', `country` = 'jfw', `email` = 'madushansachintha@gmail.com', `contact` = '0871487'  WHERE `user`.`id` = 5";

}

if(isset($_GET['id'])){
    $id=$_GET['id'];
    $getperson="SELECT * FROM user WHERE id=$id";
}

$getdata = "SELECT `id`,`firstName`, `lastName`, `screenName`, `dob`, `gender`, `country`, `email`, `contact`, `password` FROM USER ";

?>
