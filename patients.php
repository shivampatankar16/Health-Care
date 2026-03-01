<?php
session_start();
include "db.php";

/* Security check */
if(!isset($_SESSION['admin_id'])){
    header("Location: login.php");
    exit;
}

/* Fetch patient records */
$patients = mysqli_query($conn, "SELECT * FROM patients ORDER BY admission_date DESC");
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Patient Records</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<style>
:root{
    --bg:#000;
    --panel:#0B0B0B;
    --card:#121212;
    --red:#E10600;
    --white:#fff;
    --muted:#b3b3b3;
    --border:rgba(255,255,255,.08);
}
*{margin:0;padding:0;box-sizing:border-box;font-family:Segoe UI,sans-serif;}
body{
    background:linear-gradient(135deg,#000,#0B0B0B,#000);
    color:var(--white);
}

/* HEADER */
header{
    padding:20px 40px;
    display:flex;
    justify-content:space-between;
    align-items:center;
    border-bottom:1px solid var(--border);
}
.logo{
    font-size:1.6rem;
    font-weight:900;
    color:var(--red);
}
a.back{
    color:var(--red);
    text-decoration:none;
    font-weight:700;
}

/* CONTAINER */
.container{
    max-width:1200px;
    margin:60px auto;
    padding:0 20px;
}
h2{
    margin-bottom:25px;
    font-size:2rem;
}

/* TABLE */
table{
    width:100%;
    border-collapse:collapse;
    background:var(--panel);
    border-radius:15px;
    overflow:hidden;
}
th,td{
    padding:15px;
    text-align:center;
    border-bottom:1px solid var(--border);
}
th{color:var(--red);}
.status{
    font-weight:700;
}
.admitted{color:#4dff88;}
.discharged{color:#ff4d4d;}
</style>
</head>

<body>

<header>
    <div class="logo">🏥 PATIENT RECORDS</div>
    <a href="dashboard.php" class="back">← Back to Dashboard</a>
</header>

<div class="container">
    <h2>All Patients</h2>

    <table>
        <tr>
            <th>ID</th>
            <th>Patient Name</th>
            <th>Age</th>
            <th>Disease</th>
            <th>Admission Type</th>
            <th>Bed Type</th>
            <th>Status</th>
            <th>Date</th>
        </tr>

        <?php while($p = mysqli_fetch_assoc($patients)){ ?>
        <tr>
            <td><?php echo $p['patient_id']; ?></td>
            <td><?php echo $p['patient_name']; ?></td>
            <td><?php echo $p['age']; ?></td>
            <td><?php echo $p['disease']; ?></td>
            <td><?php echo $p['admission_type']; ?></td>
            <td><?php echo $p['bed_type']; ?></td>
            <td class="status <?php echo strtolower($p['status']); ?>">
                <?php echo $p['status']; ?>
            </td>
            <td><?php echo date("d M Y", strtotime($p['admission_date'])); ?></td>
        </tr>
        <?php } ?>
    </table>
</div>

</body>
</html>