<?php
session_start();
include "db.php";

/* Security check */
if(!isset($_SESSION['patient_id'])){
    header("Location: patient_login.php");
    exit;
}

/* Fetch bed availability */
$beds = mysqli_query($conn,"SELECT * FROM beds");

/* Fetch ONLY logged-in patient's records (CORRECT LOGIC) */
$patient_id = intval($_SESSION['patient_id']);
$records = mysqli_query($conn,"
    SELECT * FROM patients
    WHERE patient_login_id = $patient_id
");
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Patient Dashboard</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

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
.logout{
    color:var(--red);
    text-decoration:none;
    font-weight:700;
}

/* CONTAINER */
.container{
    max-width:1200px;
    margin:50px auto;
    padding:0 20px;
}

/* SECTION */
.section{
    margin-top:60px;
}
.section h2{
    margin-bottom:20px;
    font-size:1.8rem;
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
.status-admitted{color:#4dff88;font-weight:700;}
.status-discharged{color:#ff4d4d;font-weight:700;}

/* GRID */
.grid{
    display:grid;
    grid-template-columns:repeat(auto-fit,minmax(230px,1fr));
    gap:30px;
}
.card{
    background:var(--card);
    border:1px solid var(--border);
    border-radius:18px;
    padding:30px;
    text-align:center;
}
.card h3{
    font-size:2.4rem;
    color:var(--red);
}
.card p{color:var(--muted);}
</style>
</head>

<body>

<header>
    <div class="logo">🏥 PATIENT DASHBOARD</div>
    <a href="logout.php" class="logout">Logout</a>
</header>

<div class="container">

    <!-- WELCOME -->
    <h2>Welcome, <?php echo htmlspecialchars($_SESSION['patient_name']); ?></h2>

    <!-- BED AVAILABILITY -->
    <div class="section">
        <h2>Hospital Bed Availability</h2>
        <table>
            <tr>
                <th>Bed Type</th>
                <th>Available Beds</th>
                <th>Status</th>
            </tr>
            <?php while($b = mysqli_fetch_assoc($beds)){ ?>
            <tr>
                <td><?php echo $b['bed_type']; ?></td>
                <td><?php echo $b['available_beds']; ?></td>
                <td><?php echo $b['status']; ?></td>
            </tr>
            <?php } ?>
        </table>
    </div>

    <!-- MEDICAL RECORDS -->
    <div class="section">
        <h2>Your Medical Records</h2>
        <table>
            <tr>
                <th>Disease</th>
                <th>Admission Type</th>
                <th>Bed Type</th>
                <th>Status</th>
            </tr>
            <?php if(mysqli_num_rows($records) > 0){ ?>
                <?php while($r = mysqli_fetch_assoc($records)){ ?>
                <tr>
                    <td><?php echo $r['disease']; ?></td>
                    <td><?php echo $r['admission_type']; ?></td>
                    <td><?php echo $r['bed_type']; ?></td>
                    <td class="<?php echo ($r['status']=='Admitted') ? 'status-admitted' : 'status-discharged'; ?>">
                        <?php echo $r['status']; ?>
                    </td>
                </tr>
                <?php } ?>
            <?php } else { ?>
                <tr>
                    <td colspan="4" style="color:#b3b3b3;">
                        No medical records found. Please contact hospital.
                    </td>
                </tr>
            <?php } ?>
        </table>
    </div>

    <!-- TREATMENT GRAPH -->
    <div class="section">
        <h2>Treatment / Operation Progress</h2>
        <canvas id="myChart"></canvas>
    </div>

</div>

<script>
new Chart(document.getElementById('myChart'), {
    type: 'line',
    data: {
        labels: ['Jan','Feb','Mar','Apr','May'],
        datasets: [{
            label: 'Recovery Progress (%)',
            data: [10, 30, 45, 70, 90],
            borderColor: '#E10600',
            backgroundColor: 'rgba(225,6,0,0.2)',
            fill: true,
            tension: 0.4
        }]
    },
    options: {
        plugins: {
            legend: { labels: { color: '#ffffff' } }
        },
        scales: {
            x: { ticks: { color: '#ffffff' } },
            y: { ticks: { color: '#ffffff' } }
        }
    }
});
</script>

</body>
</html>