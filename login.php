<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link href="assets/css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <style>
        body{
  background-color: rgb(19, 16, 16);
}
#container{
  /* border: 2px solid; */
  width: 400px;
  height: 400px;
  margin-top: 100px;
  border-radius: 10px;
  position: relative;
  overflow: hidden;
  padding: 8px;

}
.box{
  height: 100%;
  width: 100%;
  border: 2px solid;
  border-radius: 10px;
  position: relative;
  z-index: 99;
  background-color: rgb(168, 196, 219);
  
}
.container::after{
  content: "";
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%,-50% ) rotate(45deg);
  height: 600px;
  width: 200px;
  background-color: rgb(17, 211, 11);
  animation: move 1.5s infinite;
  
}

@keyframes move {
  100%{
      transform: translate(-50%,-50% ) rotate(225deg);
  }
  
}
form{
  display: flex;
  flex-direction: column;
  padding: 15px 15px;
  font-size: 20px;
  margin: 10px;

}
h1{
  display: flex;
  justify-content: center;
  padding:10px;
}
input{
  border-radius: 5px;
  /* margin: 50px; */
  
}
.btn{
  float: right;
  margin: 6%;
}
.container-fluid a{
  font-size: 20px;
}
    </style>
</head>
<body class="bg-dark">
    <div class="container" id="container">
        <div class="box">
            <h1><span>Login Form</span></h1>
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                <label for="username">Username</label>
                <input type="text" name="username" id="username" placeholder="Enter username" required>
                <label for="password">Password</label>
                <input type="password" name="password" id="password" placeholder="Enter password" required>
                <button type="submit" name="login" class="btn btn-dark ">Login</button>
            </form>
            <?php
                if(isset($_POST['login'])){
                    include "NiceAdmin/config.php";
                    
                    // Get the username and password from POST request
                    $username = mysqli_real_escape_string($conn, $_POST['username']);
                    $password = $_POST['password']; // Hash the password using md5

                    // SQL query to check if the user exists
                    $sql = "SELECT user_id, username FROM admin WHERE username = '{$username}' AND password = '{$password}'";
                    $result = mysqli_query($conn, $sql) or die("Query Failed");

                    
                    if(mysqli_num_rows($result) > 0){
                        session_start();
                        $row = mysqli_fetch_assoc($result);
                        $_SESSION["username"] = $row['username'];
                        $_SESSION["user_id"] = $row['user_id'];

                      
                        header("Location: http://localhost/himtaj/niceadmin/index.php");
                        exit(); 
                    } else {
                        echo '<div class="text-danger mt-3">Username or password are incorrect.</div>';
                    }
                }
            ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
