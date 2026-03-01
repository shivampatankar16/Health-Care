<?php
session_start();
include "db.php";

if(isset($_POST['login'])){
    $email = $_POST['email'];
    $password = $_POST['password'];

    $res = mysqli_query($conn,"SELECT * FROM patients_login WHERE email='$email'");
    $p = mysqli_fetch_assoc($res);

    if($p && password_verify($password, $p['password'])){
        $_SESSION['patient_id'] = $p['patient_id'];
        $_SESSION['patient_name'] = $p['name'];
        header("Location: patient_dashboard.php");
        exit;
    } else {
        $error = "Invalid Email or Password";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Patient Login</title>
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
*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:Segoe UI, sans-serif;
}
body{
    height:100vh;
    display:flex;
    align-items:center;
    justify-content:center;
    background:linear-gradient(135deg,#000,#0B0B0B,#000);
    color:var(--white);
}

/* LOGIN BOX */
.login-box{
    width:420px;
    background:var(--card);
    border:1px solid var(--border);
    border-radius:20px;
    padding:40px;
    box-shadow:0 25px 60px rgba(0,0,0,.7);
}

/* TITLE */
.login-box h2{
    text-align:center;
    color:var(--red);
    font-size:2rem;
    margin-bottom:8px;
}
.login-box p{
    text-align:center;
    color:var(--muted);
    margin-bottom:30px;
}

/* INPUTS */
input{
    width:100%;
    padding:14px;
    margin-bottom:18px;
    border-radius:10px;
    border:1px solid var(--border);
    background:#000;
    color:#fff;
    font-size:1rem;
}
input::placeholder{color:var(--muted);}

/* BUTTON */
button{
    width:100%;
    padding:14px;
    background:var(--red);
    border:none;
    border-radius:10px;
    font-weight:800;
    font-size:1rem;
    cursor:pointer;
}
button:hover{opacity:.9;}

/* ERROR */
.error{
    margin-top:15px;
    text-align:center;
    color:#ff4d4d;
    font-weight:600;
}

/* LINKS */
.links{
    text-align:center;
    margin-top:22px;
}
.links a{
    color:var(--red);
    text-decoration:none;
    font-weight:600;
}
</style>
</head>

<body>

<div class="login-box">
    <h2>🏥 Patient Login</h2>
    <p>Access Your Health Dashboard</p>

    <form method="post">
        <input type="email" name="email" placeholder="Email Address" required>
        <input type="password" name="password" placeholder="Password" required>
        <button name="login">Login</button>
    </form>

    <?php if(isset($error)){ ?>
        <div class="error"><?php echo $error; ?></div>
    <?php } ?>

    <div class="links">
        <p>New Patient?</p>
        <a href="patient_register.php">Create Account</a><br><br>
        <a href="index.php">← Back to Home</a>
    </div>
</div>

</body>
</html>