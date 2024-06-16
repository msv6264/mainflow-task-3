<!-- started on 21st may 2024 -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="login.css">
</head>
<body>
    <div class="container">
        <h1>Login</h1>
        <form action="login.php" method="post" id="form">
            <input type="email" name="email" id="email" placeholder="Enter your email id : ">
            <br>
            <br>
            <input type="password" name="password" id="password" placeholder="Enter password">
            <br><br>
            <button class="btn">Submit</button>
        </form>
    </div>
</body>

</html>
<?php
if(isset($_POST['email'])){
    $server = "localhost";
    $username = "root";
    $password = "";
    $dbname = "portfolio";
    $con = new mysqli($server, $username, $password, $dbname);

    if($con->connect_error){
        die("Connection failed: " . $con->connect_error);
    }

    $email = $_POST['email'];
    $password = $_POST['password'];
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Use prepared statements to prevent SQL injection
    $stmt = $con->prepare("INSERT INTO `portfolio` (`email`, `password`, `dt`) VALUES (?, ?, current_timestamp())");
    if (!$stmt) {
        die("Preparation failed: " . $con->error);
    }
    $stmt->bind_param("ss", $email, $password);

    if($stmt->execute()){
        header('Location: /port-pro/index.html');
        exit();
    } else {
        echo "ERROR: " . $stmt->error;
    }

    $stmt->close();
    $con->close();
}
?>
