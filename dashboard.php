<?php
session_start();
include "db.php";

/* Security check */
if(!isset($_SESSION['admin_id'])){
    header("Location: login.php");
    exit;
}

/* Fetch hospital status */
$status = mysqli_fetch_assoc(
    mysqli_query($conn,"SELECT * FROM hospital_status WHERE id=1")
);

/* Fetch bed data */
$beds = mysqli_query($conn,"SELECT * FROM beds");

/* Count admitted patients */
$patientCount = mysqli_num_rows(
    mysqli_query($conn,"SELECT * FROM patients")
);

/* Fetch registered patients (for admit dropdown) */
$patientLogins = mysqli_query($conn,"SELECT patient_id, name FROM patients_login");
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Admin / Doctor Dashboard</title>
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
body{background:linear-gradient(135deg,#000,#0B0B0B,#000);color:var(--white);}

/* HEADER */
header{
    padding:20px 40px;
    display:flex;
    justify-content:space-between;
    align-items:center;
    border-bottom:1px solid var(--border);
}
.logo{font-size:1.6rem;font-weight:900;color:var(--red);}
.user{color:var(--muted);}
.user span{color:var(--red);}
.logout{color:var(--red);text-decoration:none;font-weight:700;}

/* CONTAINER */
.container{max-width:1300px;margin:60px auto;padding:0 20px;}

/* GRID */
.grid{
    display:grid;
    grid-template-columns:repeat(auto-fit,minmax(220px,1fr));
    gap:30px;
}
.card{
    background:var(--card);
    border:1px solid var(--border);
    border-radius:18px;
    padding:35px;
    text-align:center;
}
.card h3{font-size:2.6rem;color:var(--red);}
.card p{color:var(--muted);}

/* SECTION */
.section{margin-top:80px;}
.section h2{margin-bottom:20px;font-size:2rem;}

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

/* FORM */
form.admit-form{
    background:var(--panel);
    padding:25px;
    border-radius:15px;
    max-width:600px;
}
form.admit-form input,
form.admit-form select{
    width:100%;
    padding:12px;
    margin-bottom:15px;
    background:#000;
    color:#fff;
    border:1px solid var(--border);
    border-radius:8px;
}
button{
    padding:10px 20px;
    background:var(--red);
    border:none;
    border-radius:8px;
    font-weight:700;
    cursor:pointer;
}
button:hover{opacity:.85;}
.success{color:#4dff88;font-weight:700;margin-bottom:15px;}
</style>
</head>

<body>

<header>
    <div class="logo">🏥 ADMIN / DOCTOR DASHBOARD</div>
    <div class="user">
        Welcome, <span><?php echo $_SESSION['name']; ?></span> |
        <a href="logout.php" class="logout">Logout</a>
    </div>
</header>

<div class="container">

    <!-- STAT CARDS -->
    <div class="grid">
        <div class="card">
            <h3><?php echo $status['emergency_patients']; ?></h3>
            <p>Emergency Patients</p>
        </div>
        <div class="card">
            <h3><?php echo $status['icu_beds']; ?></h3>
            <p>Available ICU Beds</p>
        </div>
        <div class="card">
            <h3><?php echo $status['staff_on_duty']; ?></h3>
            <p>Staff On Duty</p>
        </div>
        <div class="card">
            <h3><?php echo $patientCount; ?></h3>
            <p>Admitted Patients</p>
        </div>
    </div>

    <!-- ADMIT PATIENT -->
    <div class="section">
        <h2>Admit Patient</h2>

        <?php if(isset($_GET['admitted'])){ ?>
            <div class="success">✔ Patient admitted successfully</div>
        <?php } ?>

        <form class="admit-form" method="post" action="admit_patient.php">
            <select name="patient_login_id" required>
                <option value="">Select Registered Patient</option>
                <?php while($p=mysqli_fetch_assoc($patientLogins)){ ?>
                    <option value="<?php echo $p['patient_id']; ?>">
                        <?php echo $p['name']; ?> (ID: <?php echo $p['patient_id']; ?>)
                    </option>
                <?php } ?>
            </select>

            <input type="number" name="age" placeholder="Age" required>
            <input type="text" name="disease" placeholder="Disease" required>

            <select name="admission_type">
                <option value="Emergency">Emergency</option>
                <option value="Normal">Normal</option>
            </select>

            <select name="bed_type">
                <option value="ICU">ICU</option>
                <option value="General">General</option>
                <option value="Ventilator">Ventilator</option>
            </select>

            <button name="admit">Admit Patient</button>
        </form>
    </div>

    <!-- BED MANAGEMENT -->
    <div class="section">
        <h2>Bed Availability Management</h2>
        <table>
            <tr>
                <th>Bed Type</th>
                <th>Total</th>
                <th>Available</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
            <?php while($b=mysqli_fetch_assoc($beds)){ ?>
            <tr>
                <form method="post" action="update_beds.php">
                    <td><?php echo $b['bed_type']; ?></td>
                    <td><?php echo $b['total_beds']; ?></td>
                    <td>
                        <input type="number" name="available"
                               value="<?php echo $b['available_beds']; ?>">
                    </td>
                    <td><?php echo $b['status']; ?></td>
                    <td>
                        <input type="hidden" name="bed_id" value="<?php echo $b['bed_id']; ?>">
                        <button name="update">Update</button>
                    </td>
                </form>
            </tr>
            <?php } ?>
        </table>
    </div>

    <!-- PATIENT RECORDS -->
    <div class="section">
        <h2>Patient Records</h2>
        <a href="patients.php" style="color:var(--red);font-weight:700;">
            ➜ View All Patient Records
        </a>
    </div>

</div>

</body>
</html>