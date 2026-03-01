<?php
include "db.php";

if(isset($_POST['register'])){
    $name  = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Check duplicate email
    $check = mysqli_query($conn,"SELECT * FROM patients_login WHERE email='$email'");
    if(mysqli_num_rows($check) > 0){
        $error = "Email already registered";
    } else {
        $query = "INSERT INTO patients_login (name,email,password)
                  VALUES ('$name','$email','$password')";
        if(mysqli_query($conn,$query)){
            $success = "Registration successful! Please login.";
        } else {
            $error = "Registration failed!";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Patient Registration</title>
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

/* REGISTER BOX */
.register-box{
    width:460px;
    background:var(--card);
    border:1px solid var(--border);
    border-radius:20px;
    padding:40px;
    box-shadow:0 25px 60px rgba(0,0,0,.7);
}

/* TITLE */
.register-box h2{
    text-align:center;
    color:var(--red);
    font-size:2rem;
    margin-bottom:8px;
}
.register-box p{
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

/* MESSAGES */
.msg{
    margin-top:15px;
    text-align:center;
    font-weight:600;
}
.success{color:#4dff88;}
.error{color:#ff4d4d;}

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

<div class="register-box">
    <h2>🏥 Patient Registration</h2>
    <p>Create your health account</p>

    <form method="post">
        <input type="text" name="name" placeholder="Full Name" required>
        <input type="email" name="email" placeholder="Email Address" required>
        <input type="password" name="password" placeholder="Password" required>
        <button name="register">Register</button>
    </form>

    <?php if(isset($success)){ ?>
        <div class="msg success"><?php echo $success; ?></div>
    <?php } ?>

    <?php if(isset($error)){ ?>
        <div class="msg error"><?php echo $error; ?></div>
    <?php } ?>

    <div class="links">
        <p>Already registered?</p>
        <a href="patient_login.php">Login Here</a><br><br>
        <a href="index.php">← Back to Home</a>
    </div>
</div>

</body>
</html>