<?php
include "db.php";

if(isset($_POST['register'])){
    $name  = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $role  = $_POST['role'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Check if email already exists
    $check = mysqli_query($conn,"SELECT * FROM admin WHERE email='$email'");
    if(mysqli_num_rows($check) > 0){
        $error = "Email already registered!";
    } else {
        $query = "INSERT INTO admin (name,email,password,role)
                  VALUES ('$name','$email','$password','$role')";
        if(mysqli_query($conn,$query)){
            $success = "Registration successful! You can login now.";
        } else {
            $error = "Registration failed!";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Admin / Doctor Registration</title>
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
    margin-bottom:10px;
}
.register-box p{
    text-align:center;
    color:var(--muted);
    margin-bottom:30px;
}

/* INPUTS */
input, select{
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
select option{background:#000;color:#fff;}

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
    margin-top:20px;
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
    <h2>🏥 Create Account</h2>
    <p>Admin / Doctor Registration</p>

    <form method="post">
        <input type="text" name="name" placeholder="Full Name" required>
        <input type="email" name="email" placeholder="Email Address" required>
        <input type="password" name="password" placeholder="Password" required>

        <select name="role" required>
            <option value="">Select Role</option>
            <option value="Doctor">Doctor</option>
            <option value="Admin">Admin</option>
        </select>

        <button name="register">Register</button>
    </form>

    <?php if(isset($success)){ ?>
        <div class="msg success"><?php echo $success; ?></div>
    <?php } ?>

    <?php if(isset($error)){ ?>
        <div class="msg error"><?php echo $error; ?></div>
    <?php } ?>

    <div class="links">
        <p>Already have an account?</p>
        <a href="login.php">Login Here</a><br><br>
        <a href="index.php">← Back to Home</a>
    </div>
</div>

</body>
</html>