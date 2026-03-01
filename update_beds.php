<?php
session_start();
include "db.php";

if(!isset($_SESSION['admin_id'])){
    header("Location: login.php");
    exit;
}

if(isset($_POST['update'])){
    $bed_id    = intval($_POST['bed_id']);
    $available = intval($_POST['available']);

    // Auto status logic
    $status = ($available > 0) ? 'Available' : 'Full';

    $sql = "UPDATE beds 
            SET available_beds = $available,
                status = '$status'
            WHERE bed_id = $bed_id";

    if(mysqli_query($conn, $sql)){
        header("Location: dashboard.php?success=1");
        exit;
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>