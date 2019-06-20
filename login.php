<head>
<meta charset="UTF-8">
<title>Knock Home Page</title>
<link rel="stylesheet" href="./style.css">

</head>

<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>

<form action="login.php" method="POST">

<div class="sidenav">
<div class="login-main-text">
<h2>Knock</h2>
<p>Login or register, and start Knockin'.</p>
</div>
</div>

<div class="main">
<div class="col-md-6 col-sm-12">
<div class="login-form">
<label for="uname"><b>Username</b></label>
<input class="form" type="text" placeholder="Enter Username" name="uname" required> <br>

<label for="psw"><b>Password</b></label>
<input type="password" placeholder="Enter Password" name="psw" required> <br>
<label>

<button type="submit" class="btn btn-black">Login</button>

<a href="register.php" class="btn btn-secondary">Register </a>

</div>
</form>

<div class="message">
<?php  print("<pre>".print_r($row,true)."</pre>"); ?>
</div>

<?php
    session_start();
    $username = $_POST['uname'];
    $password = $_POST['psw'];
    //$password = base64_encode($password);
    $_SESSION["uname"] = $username;
    $username = stripcslashes($username);
    $password = stripcslashes($password);
    //echo "$username";
    //echo "\n";
    //echo "$password";
    $conn = new mysqli("localhost", "knock", "fb4knock", "knock");
    $_SESSION["connection"] = $conn;
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    
    $sql= "SELECT * FROM usernames WHERE username = '$username' and password = '$password'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();

    
    if($result->num_rows > 0){
        if($row["username"]==$username && $row["password"] == $password){
            
            $sql = "SELECT facebook, instagram, snapchat, twitter FROM usernames WHERE username='sambudd'";
            $result = $conn->query($sql);
            $row = $result->fetch_assoc();
            
            echo 'You are logged in!';
            echo $username;
            print("<pre>".print_r($row,true)."</pre>");
    
        }
        else {
            echo 'Something went wrong. Try again!';
        }
    }
    
    mysqli_close($conn);
    ?>
