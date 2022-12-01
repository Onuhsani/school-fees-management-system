<?php

include("php/dbconnect.php");
include("php/check.php");

if(isset($_POST['reg'])){
    $ch = 0; 
    if($ch == 0){
        $user = $_SESSION['uid'];
        $re = "INSERT INTO registrations(stu_id,course_code,course_title) VALUES('$user','$d1','$d2')";
        $run = $conn->query($re);
        $dn = "Register";
        $ch = 1;
        echo "<script>alert('Course registered successfully')</script>";
    }else{
        echo "<script>alert('Already Registered')</script>";
    }
    
}

?>