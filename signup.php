<?php

$username = $_POST['username'];
$Email  = $_POST['Email'];
$Password = $_POST['Password'];
$Conform password = $_POST['Conform password'];




if (!empty($username) || !empty($Email) || !empty($Password) || !empty($Conform password) )
{

$host = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "login";



// Create connection
$conn = new mysqli ($host, $dbusername, $dbpassword, $dbname);

if (mysqli_connect_error()){
  die('Connect Error ('. mysqli_connect_errno() .') '
    . mysqli_connect_error());
}
else{
  $SELECT = "SELECT Email From signup Where Email = ? Limit 1";
  $INSERT = "INSERT Into signup (username , Email ,Password, Conform password )values(?,?,?,?)";

//Prepare statement
     $stmt = $conn->prepare($SELECT);
     $stmt->bind_param("s", $Email);
     $stmt->execute();
     $stmt->bind_result($Email);
     $stmt->store_result();
     $rnum = $stmt->num_rows;

     //checking username
      if ($rnum==0) {
      $stmt->close();
      $stmt = $conn->prepare($INSERT);
      $stmt->bind_param("ssss", $username,$Email,$Password,$Conform password);
      $stmt->execute();
      echo "New record inserted sucessfully";
     } else {
      echo "Someone already register using this email";
     }
     $stmt->close();
     $conn->close();
    }
} else {
 echo "All field are required";
 die();
}
?>