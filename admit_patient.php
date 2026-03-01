<?php
session_start();
include "db.php";

if(!isset($_SESSION['admin_id'])){
    header("Location: login.php");
    exit;
}

if(isset($_POST['admit'])){
    $pid   = $_POST['patient_login_id'];
    $name  = $_POST['patient_name'];
    $age   = $_POST['age'];
    $dis   = $_POST['disease'];
    $type  = $_POST['admission_type'];
    $bed   = $_POST['bed_type'];

    mysqli_query($conn,"
        INSERT INTO patients
        (patient_login_id, patient_name, age, disease, admission_type, bed_type, status)
        VALUES
        ('$pid','$name','$age','$dis','$type','$bed','Admitted')
    ");

    header("Location: dashboard.php?admitted=1");
}
?>